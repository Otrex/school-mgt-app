<?php

namespace App\Http\Livewire\Admin\Community;

use Livewire\Component;
use App\Models\Community;
use App\Models\TertiaryInstitution;
use App\Traits\LocalGovernmentTown;
use App\Traits\Utilities;
use Illuminate\Support\Facades\Hash;

class Add extends Component
{
    use LocalGovernmentTown, Utilities;

    public $first_name;

    public $last_name;

    public $email;

    public $phone_number;

    public $gender;

    public $home_address;

    public $state = 4;

    public $local_government;

    public $town;

    public $is_tertiary_institution;

    protected array $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'phone_number' => 'required|string|max:11',
        'email' => 'required|email|unique:users',
        'gender' => 'required|string',
        'state' => 'required',
        'local_government' => 'required',
        'town' => 'required',
        'home_address' => 'required|string',
    ];

    public function add()
    {
        $this->validate();

        $user = Community::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone_number,
            'password' => Hash::make($this->phone_number),
            'gender' => $this->gender,
            'state' => $this->getStateName($this->state),
            'state_id' => $this->state,
            'local_government' => $this->getLocalGovernmentName($this->local_government),
            'local_government_id' => $this->local_government,
            'town' => ($this->is_tertiary_institution) ? $this->getTertiaryInstitutionName($this->town) : $this->getTownName($this->town),
            'town_id' => ($this->is_tertiary_institution) ? null : $this->town,
            'tertiary_institution_id' => ($this->is_tertiary_institution) ? $this->town : null,
            'is_tertiary_institution' => $this->is_tertiary_institution ?? false,
            'home_address' => $this->home_address,
        ]);

        $this->dispatchBrowserEvent('success', 'New community member added successfully!');

        $this->reset([
            'first_name',
            'last_name',
            'phone_number',
            'email',
            'gender',
            'state',
            'local_government',
            'town',
            'is_tertiary_institution',
            'home_address',
        ]);

        $this->updateReferralCode($user);
    }

    public function render()
    {
        $states = $this->states();
        $local_governments = (isset($this->state)) ? $this->localGovernments($this->state) : [];
        $towns = (isset($this->local_government)) ? $this->towns($this->local_government) : [];

        $tertiary_institutions = isset($this->local_government) ?
            TertiaryInstitution::where('local_government', $this->getLocalGovernmentName($this->local_government))->get() : [];

        title('Admin - Add Community Member');

        return view('livewire.admin.community.add', compact('states', 'local_governments', 'towns', 'tertiary_institutions'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
