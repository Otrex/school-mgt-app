<?php

namespace App\Http\Livewire\Admin\Community;

use Livewire\Component;
use App\Models\Community;
use App\Models\TertiaryInstitution;
use App\Traits\LocalGovernmentTown;

class View extends Component
{
    use LocalGovernmentTown;

    public Community $member;

    protected array $rules = [
        'member.first_name' => 'required|string',
        'member.last_name' => 'required|string',
        'member.phone' => 'required|string|max:11',
        'member.email' => 'required|email',
        'member.gender' => 'required',
        'member.state_id' => 'required',
        'member.local_government_id' => 'required',
        'member.town_id' => 'required',
        'member.is_tertiary_institution' => 'nullable',
        'member.home_address' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        $tertiary_institution_id = ($this->member->is_tertiary_institution) ? $this->member->town_id : null;

        $this->member->state = $this->getStateName($this->member->state_id);
        $this->member->local_government = $this->getLocalGovernmentName($this->member->local_government_id);
        $this->member->town = ($this->member->is_tertiary_institution) ? $this->getTertiaryInstitutionName($this->member->town_id) : $this->getTownName($this->member->town_id);
        $this->member->town_id = ($this->member->is_tertiary_institution) ? null : $this->member->town_id;
        $this->member->tertiary_institution_id = $tertiary_institution_id;

        $this->member->save();

        $this->dispatchBrowserEvent("success", "Comunity member profile updated!");
    }

    public function render()
    {
        $states = $this->states();
        $local_governments = (isset($this->member->state_id)) ? $this->localGovernments($this->member->state_id) : [];
        $towns = (isset($this->member->local_government_id)) ? $this->towns($this->member->local_government_id) : [];

        $tertiary_institutions = isset($this->member->local_government_id) ?
            TertiaryInstitution::where('local_government', $this->getLocalGovernmentName($this->member->local_government_id))->get() : [];

        title('Admin - View Community Member ('.$this->member->fullname.')');

        return view('livewire.admin.community.view', compact(
                'states', 'local_governments',
                'towns', 'tertiary_institutions'
            ))
            ->extends('layouts.admin')
            ->section('content');
    }
}
