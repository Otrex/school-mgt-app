<?php

namespace App\Http\Livewire;

use App\Enums\TransactionSource;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use Exception;
use App\Models\Course;
use App\Models\Enrolment;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Unicodeveloper\Paystack\Facades\Paystack;

class Purchase extends Component
{
    public Course $course;

    public $payment_mode = 'paystack';

    public $voucher_code;

    public $email;

    public $reference;

    public function mount()
    {
        $this->reference = Paystack::genTranxRef();
    }

    public function purchaseWithVoucher()
    {
        $this->validate(['voucher_code' => 'required|string']);

        $validVoucherCode = $this->validateVoucherCode($this->voucher_code, $this->course->fee);

        if(!is_bool($validVoucherCode)) {
            $this->dispatchBrowserEvent('error', $validVoucherCode);
        } else {
            // get current authenticated user
            $auth_user = $this->getCurrentAuthUser();

            // update the status of the vourcher code
            Voucher::where('code', $this->voucher_code)->update(['is_used' => true]);

            // store payment details
            $auth_user->payments()->create([
                'course_id' => $this->course->id,
                'mode' => $this->payment_mode,
                'amount' => $this->course->fee
            ]);

            $payment_details = [
                'payment_type' => $this->payment_mode,
                'amount_paid' => $this->course->fee,
                'email' => $auth_user->email,
                'phone' => $auth_user->phone,
                'redirect_path' => "/program/{$this->course->slug}"
            ];

            Enrolment::create([
                "course_id" => $this->course->id,
                "member_id" => $auth_user->id
            ]);

            session()->put('payment_complete', $payment_details);

            return redirect()->route('transaction.success');
        }
    }

    public function validateVoucherCode(string $code, string $price)
    {
        $status = null;

        if (Voucher::where('code', $code)->get()->count() == 0) {
            $status = "Invalid voucher code";
        } elseif (Voucher::where(['code' => $code, 'price' => $price])->get()->count() == 0) {
            $status = "This voucher code does not match the price ₦{$price}";
        } elseif (Voucher::where(['code' => $code, 'price' => $price, 'is_used' => true])->get()->count() > 0) {
            $status = "This voucher code has been use";
        } else {
            $status = true;
        }

        return $status;
    }

    public function purchaseWithPaystack()
    {
        $this->validate(['email' => 'required|email']);


        // get current authenticated user
        $auth_user = $this->getCurrentAuthUser();

        if (!is_null($auth_user)) {

            // store payment details
            $ref = Paystack::genTranxRef();

            Transaction::create([
                'amount' => (int) $this->course->fee,
                'status' => TransactionStatus::INIT,
                'member_id' => $auth_user->id,
                'ref' => $ref,
                'source' => TransactionSource::COURSE_PAYMENT,
                'type' => TransactionType::CREDIT,
                'metadata' => (string) $this->course->id,
            ]);

            try {

                return Paystack::getAuthorizationUrl([
                    "amount" => (int)$this->course->fee * 100,
                    "email" => $this->email,
                    "reference" => $ref,
                    "currency" => "NGN",
                ])->redirectNow();

            } catch (Exception $e) {
                $this->dispatchBrowserEvent('error', 'The paystack token has expired. Please refresh the page and try again.');
                return redirect()->back();
            }
        } else {
            $this->dispatchBrowserEvent('error', 'You need to login to perform this transaction');
        }
    }

    public function getCurrentAuthUser()
    {
        $auth_user = null;
        $student_is_logged_in = Auth::check();
        $community_member_is_logged_in = Auth::guard('community')->check();
        if ($student_is_logged_in && $community_member_is_logged_in) {
            $this->dispatchBrowserEvent('error', 'There are two authenticated user, please kindly logout one of the user');
        } else {
            if ($student_is_logged_in)
                $auth_user = Auth::user();

            if($community_member_is_logged_in)
                $auth_user = Auth::guard('community')->user();
        }

        return $auth_user;
    }

    public function render()
    {
        $auth_user = $this->getCurrentAuthUser();

        $this->email = $auth_user->email;

        title('Program Purchase');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.purchase', compact('auth_user'))
            ->extends('layouts.app')
            ->section('content');
    }
}