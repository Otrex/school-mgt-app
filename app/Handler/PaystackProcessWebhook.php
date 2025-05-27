<?php

namespace App\Handler;

use App\Enums\PaymentFrequency;
use App\Enums\TransactionType;
use App\Enums\TransactionSource;
use App\Enums\TransactionStatus;
use App\Models\Community;
use App\Models\Enrolment;
use App\Models\ScholarshipSlot;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use \Spatie\WebhookClient\Jobs\ProcessWebhookJob;


class PaystackProcessWebhook extends ProcessWebhookJob
{
    public function getPayload()
    {
        $data = json_decode($this->webhookCall, true);
        return $data['payload']['data'];
    }

    public function handle(){

       $payload = $this->getPayload();

       $transaction = Transaction::where('ref', $payload['reference'])->first();

       if (!$transaction) {
            $transaction = Transaction::create([
                'amount' => $payload['amount'] / 100,
                'ref' => $payload['reference'],
                'source' => $payload['customer']['email']
            ]);
       }

       $transaction->status = TransactionStatus::COMPLETED;
       $transaction->save();

        switch (TransactionSource::tryFrom($transaction->source)) {
            case TransactionSource::CONTRIBUTION:
                $this->handleContributionTransactions($transaction);
                break;
            case TransactionSource::COURSE_PAYMENT:
                $this->handleCoursePayment($transaction);
                break;
            default:
                Log::debug("no handler for {$transaction->source}");
                break;
       }

       http_response_code(200);
    }

    public function handleCoursePayment(Transaction $transaction)
    {
        $member = Community::where('id', $transaction->member_id)->first();
        if (!$member) {
            $member = User::where('id', $transaction->member_id)->first();
        }

        if (!$member) {
            Log::error("Course payment transaction with id '{$transaction->id}' has no legit owner");
            return;
        }

        $member->payments()->create([
            'course_id' => (int) $transaction->metadata,
            'mode' => 'paystack',
            'amount' => $transaction->amount
        ]);

        Enrolment::create([
            "course_id" => (int) $transaction->metadata,
            "member_id" => $member->id
        ]);
    }

    public function handleContributionTransactions(Transaction $transaction)
    {
        $payload = $this->getPayload();
        $member = Community::where('id', $transaction->member_id)->first();
        if (!$member) {
            Log::error("Donation transaction with id '{$transaction->id}' has no legit owner");
            return;
        }

        $payment_frequency = $member->patron->payment_frequency;
        $member->patron->amount_contributed += $transaction->amount;
        if ($payment_frequency != PaymentFrequency::ONE_TIME->value) {
            $member->patron->payment_authorization_code = $payload['authorization']['authorization_code'];

            // Update next due date
            $next_due_date = null;
            if ($payment_frequency == PaymentFrequency::MONTHLY->value) {
                $next_due_date = now()->addMonth();
            } elseif ($payment_frequency == PaymentFrequency::QUARTERLY->value) {
                $next_due_date = now()->addQuarter();
            }
            $member->patron->next_due_date = $next_due_date;
        }
        $member->patron->save();

        // Creates Record For Maintenance
        Transaction::create([
            'type' => TransactionType::CREDIT,
            'source' => TransactionSource::MAINTENANCE,
            'amount' => $transaction->amount * config('app.maintenance_percentage'),
            'status' => TransactionStatus::COMPLETED,
            'member_id' => $transaction->member_id,
            'ref' => 'maintenance-'.now()->format('YmdHis'),
            'parent_id' => $transaction->id
        ]);

        $this->createScholarshipSlots($member,$transaction);
    }

    public function createScholarshipSlots(Community $member, Transaction $transaction)
    {
        $paid_amount = $transaction->amount;
        $in_active_slots = ScholarshipSlot::where('is_active', false)
            ->where('patron_id', $member->patron->id)
            ->get();

        if (count($in_active_slots) > 0) {
            foreach ($in_active_slots as $slot) {
                $paid_amount -= $slot->amount_left;
                $slot->is_active = true;
                $slot->amount_left = 0;
                $slot->save();
            }
        }

        [
            'quotient' => $active_slot_count,
            'remainder' => $balance
        ] = quotientAndRemainder(
            $paid_amount,
            config('app.scholarship_cost')
        );

        $slots = [];

        for ($i = 1; $i <= $active_slot_count; $i++) {
            $slots[] = [
                'patron_id' => $member->id,
                'is_active' => true,
            ];
        }

        if ($balance > 0 && $active_slot_count != 0) {
            $slots[] = [
                'is_active' => false,
                'patron_id' => $member->patron->id,
                'amount_left' => config('app.scholarship_cost') - $balance,
            ];
        }

        Log::error($slots);

        ScholarshipSlot::insert($slots);
    }
}