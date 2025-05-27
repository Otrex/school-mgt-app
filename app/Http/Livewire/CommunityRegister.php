<?php

namespace App\Http\Livewire;

use App\Models\Community;
use App\Models\Referral;
use App\Models\TertiaryInstitution;
use App\Models\User;
use Livewire\Component;
use App\Traits\LocalGovernmentTown;
use App\Traits\Utilities;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CommunityRegister extends Component
{
    use LocalGovernmentTown, Utilities;

    public $first_name;

    public $last_name;

    public $phone;

    public $email;

    public $gender;

    public $password;

    public $password_confirmation;

    public $state = 4;

    public $local_government;

    public $town;

    public $home_address;

    public $privacy_policy;

    public $is_tertiary_institution;

    public $referrer_code;

    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'gender' => 'required|string',
        'phone' => 'required|string|max:11',
        'email' => 'required|email|unique:communities',
        'password' => 'required|string|min:8|confirmed',
        'state' => 'required',
        'local_government' => 'required',
        'town' => 'required',
        'home_address' => 'required|string',
        'privacy_policy' => 'required',
        'referrer_code' => 'nullable|string'
    ];

    protected $messages = [
        'privacy_policy.required' => 'You have to agree to our privacy policy'
    ];

    protected $listeners = ['tertiarySelected'];

    public $original_referrer_code;

    public function mount()
    {
        $code = request()->query('code');
        $this->referrer_code = $code;
        $this->original_referrer_code = $code;
    }

    public function register()
    {
        $this->validate();

        $referrer = null;

        if ($this->referrer_code) {
            $referrer = Community::where('referrer_code', $this->referrer_code)->first();
            if ($referrer == null) {
                $this->dispatchBrowserEvent('error', 'invalid referrer code');
                return;
            }
        }

        // register new student
        $member = Community::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'phone' => trim($this->phone),
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'state' => $this->getStateName($this->state),
            'state_id' => $this->state,
            'local_government' => $this->getLocalGovernmentName($this->local_government),
            'local_government_id' => $this->local_government,
            'town' => ($this->is_tertiary_institution) ? $this->getTertiaryInstitutionName($this->town) : $this->getTownName($this->town),
            'town_id' => ($this->is_tertiary_institution) ? null : $this->town,
            'tertiary_institution_id' => ($this->is_tertiary_institution) ? $this->town : null,
            'is_tertiary_institution' => $this->is_tertiary_institution ?? false,
            'home_address' => $this->home_address
        ]);

        // flash success message
        // $this->dispatchBrowserEvent('success', 'Registeration was successfull!');

        if ($referrer) {
            Referral::create([
                "owner_id" => $referrer->id,
                "referred_id" => $member->id,
            ]);
        }

        // reset form
        $this->reset([
            'first_name',
            'last_name',
            'gender',
            'phone',
            'email',
            'password',
            'password_confirmation',
            'state',
            'local_government',
            'is_tertiary_institution',
            'town',
            'home_address'
        ]);

        Auth::guard('community')->login($member);

        $this->updateReferralCode($member);

        event(new Registered($member));

        return redirect()->route('verification.notice');
    }

    public function render()
    {

        $states = $this->states();
        $local_governments = (isset($this->state)) ? $this->localGovernments($this->state) : [];
        $towns = (isset($this->local_government)) ? $this->towns($this->local_government) : [];

        $tertiary_institutions = isset($this->local_government) ? TertiaryInstitution::where('local_government', $this->getLocalGovernmentName($this->local_government))->get() : [];

        $ref_code = $this->referrer_code;

        $this->referrer_code = $ref_code;
        title('About Community Membership Registration');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.community-register', compact('states', 'ref_code', 'local_governments', 'towns', 'tertiary_institutions'))
            ->extends('layouts.app')
            ->section('content');
    }
}