<?php

namespace App\Http\Livewire\Community;

use App\Enums\TransactionSource;
use App\Models\Patron;
use App\Models\Transaction;
use Livewire\Component;
use App\Traits\MediaUpload;
use Livewire\WithFileUploads;
use App\Models\TertiaryInstitution;
use App\Traits\LocalGovernmentTown;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Unicodeveloper\Paystack\Facades\Paystack;
use App\Enums\TransactionStatus;
use App\Enums\TransactionType;

class Profile extends Component
{
    use LocalGovernmentTown,
        WithFileUploads,
        MediaUpload;

    public $member;
    public $patron;

    public $old_password;
    public $new_password;
    public $new_password_confirmation;

    public $avatar;

    protected array $rules = [
        'member.first_name' => 'required|string',
        'member.last_name' => 'required|string',
        'member.phone' => 'required|string|max:11',
        'member.email' => 'required|email',
        'member.gender' => 'required|string',
        'member.state' => 'required|string',
        'member.local_government' => 'required|string',
        'member.town' => 'required|string',
        'member.home_address' => 'required|string',
    ];

    protected $listeners = [
        "refresh_page" => "render"
    ];

    public function save()
    {
        $this->validate();

        $this->member->save();

        $this->dispatchBrowserEvent("success", "Profile updated!");
    }

    public function passwordReset()
    {
        try {
            $validate = $this->validate([
                'old_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            $this->dispatchBrowserEvent('error', $validate);
            return;
        }


        // Validate old password
        if (Hash::check($this->old_password, $this->member->password)) {
            // Validate if new password is same as old password
            if (!Hash::check($this->new_password, $this->member->password)) {
                // update password
                $this->member->update([
                    'password' => Hash::make($this->new_password)
                ]);

                // reset inout form
                $this->reset([
                    'new_password',
                    'old_password',
                    'new_password_confirmation'
                ]);

                $this->dispatchBrowserEvent('success', 'Password updated successfully!');
            } else {
                $this->dispatchBrowserEvent('error', 'New password can not be same as old password');
            }
        } else {
            $this->dispatchBrowserEvent('error', 'Old password does not match');
        }
    }

    public function changeProfileImage()
    {
        $this->validate(['avatar' => 'required|string']);

        $avatar = $this->storeAvatar($this->avatar, $this->member->first_name, 'avatar');

        if(!is_null($this->member->image) && !is_url($this->member->image))
            Storage::disk('public')->delete("avatar/{$this->member->image}");

        $this->member->update(['image' => $avatar]);

        $this->emit('refresh_avatar');

        $this->dispatchBrowserEvent('success', 'Profile image updated successfully!');

        $this->reset(['avatar']);
    }

    public function refreshPage() {
        $this->emitSelf('refresh_page');
    }

    public function redirectToGateway()
    {
        $this->member = Auth::guard('community')->user();

        try {
            $ref = Paystack::genTranxRef();
            $payment_amount = $this->member->patron->no_of_slots * config('app.scholarship_cost');

            Transaction::create([
                'source' => TransactionSource::CONTRIBUTION,
                'status' => TransactionStatus::INIT,
                'type' => TransactionType::CREDIT,
                'member_id' => $this->member->id,
                'amount' => $payment_amount,
                'recurrent' => true,
                'ref' => $ref,
            ]);

            $this->emit('paystack:popup', json_encode([
                'ref' => $ref,
                'amount' => $payment_amount * 100,
                "email" => $this->member->email,
                "currency" => "NGN",
                "key" => config('paystack.publicKey')
            ]));

        } catch(\Exception $e) {
            return redirect()->back()->withMessage([
                'msg' => 'The paystack token has expired. Please refresh the page and try again.',
                'type' => 'error'
            ]);
        }
    }

    public function becomePatron() {
        $this->member = Auth::guard('community')->user();
        try {
            $this->validate([
                'patron.slots' => 'required|int|min:1',
                'patron.payment_frequency' => 'required|string',
                'patron.town' => 'int',
            ]);

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('error', $th->getMessage());
            return;
        }

        Patron::create([
            'member_id' => $this->member->id,
            'no_of_slots' => $this->patron['slots'],
            'town_id' => $this->patron['town'] ?? null,
            'payment_frequency' => $this->patron['payment_frequency']
        ]);


        $this->dispatchBrowserEvent('success', 'Congratulations!!, You are now a patron!');
        $this->emit('form:submitted', 'Form submitted successfully!');
    }

    public function render()
    {
        $this->member = Auth::guard('community')->user();

        $states = $this->states();
        $local_governments = (isset($this->member->state)) ? $this->localGovernments($this->member->state) : [];
        $towns = (isset($this->member->local_government)) ? $this->towns($this->member->local_government_id) : [];

        $tertiary_institutions = isset($this->member->town) ? TertiaryInstitution::where('local_government', $this->member->local_government)->get() : [];

        title('Community Member Profile');

        return view('livewire.community.profile', compact('states', 'local_governments', 'towns', 'tertiary_institutions'))
            ->extends('layouts.community')
            ->section('content');
    }
}