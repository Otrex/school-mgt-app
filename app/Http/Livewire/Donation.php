<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Unicodeveloper\Paystack\Facades\Paystack;

class Donation extends Component
{
    public $email;

    public $amount;

    public $custom_amount;

    public $payment_cycle = 'Once';

    public $reference;

    protected $rules = [
        'email' => 'required|email',
        'amount' => 'required',
        'payment_cycle' => 'required',
    ];

    public function mount()
    {
        $this->reference = Paystack::genTranxRef();
    }

    public function donate()
    {
        if ($this->amount == 'custom amount')
            $this->rules['custom_amount'] = 'required|numeric';

        if (!empty($this->custom_amount))
            $this->amount = $this->custom_amount;

        $this->validate();

        $data = [
            "amount" => $this->amount * 100,
            "email" => $this->email,
            "reference" => $this->reference,
            "currency" => "NGN",
        ];

        if ($this->payment_cycle == "Monthly") {
            request()->request->add([
                'name' => 'Blip Computer School Donation',
                'description' => 'Donations made to blip computer school to facilitate the computer learning among school students',
                'amount' => $this->amount * 100,
                'interval' => strtolower($this->payment_cycle),
                'send_invoices' => true,
                'send_sms' => false,
                'currency' => 'NGN',
            ]);

            Paystack::createPlan();
        }

        try {
            return Paystack::getAuthorizationUrl($data)->redirectNow();
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('error', 'The paystack token has expired. Please refresh the page and try again.');

            return redirect()->back();
        }
    }

    public function render()
    {
        title('Donate to our cause');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.donation')
            ->extends('layouts.app')
            ->section('content');
    }
}
