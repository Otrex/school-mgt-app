<?php

namespace App\Http\Livewire\Auth;

use App\Models\School;
use App\Models\User;
use App\Models\Session as SchoolSession;
use App\Traits\LocalGovernmentTown;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserRegister extends Component
{
    use LocalGovernmentTown;

    public $first_name;

    public $last_name;

    public $school;

    public $gender;

    public $password;

    public $password_confirmation;

    public $state = 4;

    public $local_government;

    public $town;

    public $home_address;

    public $privacy_policy;

    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'gender' => 'required|string',
        'school' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
        'state' => 'required',
        'local_government' => 'required',
        'town' => 'required',
        'home_address' => 'required|string',
        'privacy_policy' => 'required'
    ];

    protected $messages = ['privacy_policy.required' => 'You have to agree to our privacy policy'];

    public function register()
    {
        $this->validate();

        // get current school session
        $school_session = SchoolSession::where(['default' => true])->first();

        // generate registeration number
        $reg_no = "BCS/{$school_session->created_at->format('Y')}/".rand(100000,200000);

        // get school name
        $school_name = School::where('id', $this->school)->first();

        // register new student
        User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender' => $this->gender,
            'school_id' => $this->school,
            'school' => $school_name->name,
            'reg_no' => $reg_no,
            'session_id' => $school_session->id,
            'password' => Hash::make($this->password),
            'state_id' => $this->state,
            'state' => $this->getStateName($this->state),
            'local_government_id' => $this->local_government,
            'local_government' => $this->getLocalGovernmentName($this->local_government),
            'town_id' => $this->town,
            'town' => $this->getTownName($this->town),
            'home_address' => $this->home_address
        ]);

        // flash success message
        $this->dispatchBrowserEvent('success', 'Registeration was successfull!');

        // reset form
        $this->reset([
            'first_name',
            'last_name',
            'gender',
            'school',
            'password',
            'password_confirmation',
            'state',
            'local_government',
            'town',
            'home_address'
        ]);
    }

    public function render()
    {
        $states = $this->states();
        $local_governments = (isset($this->state)) ? $this->localGovernments($this->state) : [];
        $towns = (isset($this->local_government)) ? $this->towns($this->local_government) : [];

        $schools = isset($this->town) ? School::where('town', $this->getTownName($this->town))->get() : [];

        title('Club Membership Registeration');

        return view('livewire.auth.user-register', compact('states', 'local_governments', 'towns', 'schools'))
            ->extends('layouts.app')
            ->section('content');
    }
}
