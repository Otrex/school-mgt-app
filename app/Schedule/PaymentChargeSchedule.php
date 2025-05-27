<?php

namespace App\Schedule;

use App\Enums\PaymentFrequency;
use App\Enums\TransactionSource;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Patron;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentChargeSchedule
{

    public function chargeAuthorizationCode(string $authorization_code, string $email, string $amount, string $ref)
    {
        $url = "https://api.paystack.co/transaction/charge_authorization";

        $fields = [
            'email' => $email,
            'reference' => $ref,
            'amount' => (string) $amount * 100,
            "authorization_code" => $authorization_code
        ];

        // Send a POST request using Laravel's HTTP client
        $response = Http::withHeaders([
            "Authorization" => "Bearer ". config('paystack.secretKey'),
            "Cache-Control" => "no-cache",
        ])->post($url, $fields);

        // Get the response body as a string
        return $response->body();
    }

    public function __invoke()
    {
        $patrons = Patron::where('next_due_date', '<=', now())->where('payment_frequency', '!=', PaymentFrequency::ONE_TIME->value)->get();

        foreach ($patrons as $patron) {
            $payment_frequency = $patron->payment_frequency;
            $next_due_date = null;
            if ($payment_frequency == PaymentFrequency::MONTHLY->value) {
                $next_due_date = now()->addMonth();
            } elseif ($payment_frequency == PaymentFrequency::QUARTERLY->value) {
                $next_due_date = now()->addQuarter();
            }

            $this->processPayment($patron);

            $patron->update([
                'next_due_date' =>  $next_due_date,
            ]);
        }
    }

    public function processPayment(Patron $patron)
    {
        $amount = $patron->no_of_slots * config('app.scholarship_cost');
        $auth_code = $patron->payment_authorization_code;
        $email = $patron->member->email;

        $ref = 'charge-'.Paystack::genTranxRef();

        $transaction = Transaction::create([
            'amount' => $amount,
            'source' => TransactionSource::CONTRIBUTION,
            'type' => TransactionType::CREDIT,
            'ref' => $ref,
            'status' => TransactionStatus::INIT,
            'member_id' => $patron->member->id,
        ]);

        try {
            $this->chargeAuthorizationCode(
                $auth_code,
                $email,
                $amount,
                $ref
            );
        } catch (\Throwable $th) {
            Log::error($th);
            $transaction->status = TransactionStatus::FAILED->value;
            $transaction->save();
        }
    }
}