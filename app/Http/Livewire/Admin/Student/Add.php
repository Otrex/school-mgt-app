<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\User;
use App\Models\School;
use Livewire\Component;
use App\Traits\LocalGovernmentTown;
use Illuminate\Support\Facades\Hash;
use App\Models\Session as SchoolSession;

class Add extends Component
{
    use LocalGovernmentTown;

    public $first_name;

    public $last_name;

    public $email;

    public $phone_number;

    public $gender;

    public $school;

    public $home_address;

    public $state = 4;

    public $local_government;

    public $town;

    protected array $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'phone_number' => 'nullable|string|max:11',
        'email' => 'nullable|email|unique:users',
        'gender' => 'required|string',
        'school' => 'required|string',
        'state' => 'required',
        'local_government' => 'required|string',
        'town' => 'required|string',
        'home_address' => 'required|string',
    ];

    public function add()
    {
        $this->validate();

        // get current school session
        $school_session = SchoolSession::where(['default' => true])->first();

        // current date
        $current_date = date('Y-m-d');

        if (is_null($school_session)) {

            // error message if no session has been added
            $this->dispatchBrowserEvent('error', 'School session has not been added');

            return redirect()->route('admin.session.add');

        } elseif($current_date > $school_session->end_date) {

            // error message if current session has ended
            $this->dispatchBrowserEvent("error", "The {$school_session->session} session has ended, please add a new session");
        } else {

            // generate registeration number
            $reg_no = "BCS/{$school_session->created_at->format('Y')}/".rand(100000,200000);

            $school_name = School::where('id', $this->school)->first();

            // add new student
            $student = User::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone' => $this->phone_number,
                'password' => Hash::make($reg_no),
                'gender' => $this->gender,
                'school_id' => $this->school,
                'school' => $school_name->name,
                'reg_no' => $reg_no,
                'session_id' => $school_session->id,
                'state_id' => $this->state,
                'state' => $this->getStateName($this->state),
                'local_government_id' => $this->local_government,
                'local_government' => $this->getLocalGovernmentName($this->local_government),
                'town_id' => $this->town,
                'town' => $this->getTownName($this->town),
                'home_address' => $this->home_address
            ]);

            // success alert message
            $this->dispatchBrowserEvent('success', 'New student added successfully!');

            // reset form input
            $this->reset([
                'first_name',
                'last_name',
                'phone_number',
                'email',
                'gender',
                'school',
                'state',
                'local_government',
                'town',
                'home_address',
            ]);
        }
    }

    public function render()
    {
        $states = $this->states();
        $local_governments = (isset($this->state)) ? $this->localGovernments($this->state) : [];
        $towns = (isset($this->local_government)) ? $this->towns($this->local_government) : [];

        $schools = isset($this->town) ? School::where('town', $this->getTownName($this->town))->get() : [];

        title('Admin - Add New Student');

        return view('livewire.admin.student.add', compact('states', 'local_governments', 'towns', 'schools'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
