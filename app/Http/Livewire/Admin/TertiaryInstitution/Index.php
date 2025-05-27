<?php

namespace App\Http\Livewire\Admin\TertiaryInstitution;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TertiaryInstitution;
use App\Traits\LocalGovernmentTown;

class Index extends Component
{
    use WithPagination, LocalGovernmentTown;

    public $state;

    public $local_government;

    public $town;

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function resetFilter()
    {
        $this->reset(['state', 'local_government', 'town']);
    }

    public function search()
    {
        $search = TertiaryInstitution::query();

        $schools = $search->where(function($query) {
            $query->where('name', 'like', '%'.$this->search.'%');
        })
        ->latest()
        ->paginate();

        return $schools;
    }

    public function delete($id)
    {
        if (isset($id)) {
            $student = TertiaryInstitution::find($id);

            $student->delete();

            $this->dispatchBrowserEvent('success', 'Tertiary institution deleted successfully!');
        }
    }

    public function render()
    {
        $filter = TertiaryInstitution::filter($this->state, $this->local_government, $this->town);

        $tertiary_institutions = is_null($filter) ? $this->search() : $filter;

        $states = $this->states();
        $local_governments = (isset($this->state)) ? $this->localGovernments($this->state) : [];
        $towns = (isset($this->local_government)) ? $this->towns($this->local_government) : [];

        // tertiary instiution count
        $tertiary_institution_count = TertiaryInstitution::count();

        // Count all states
        $state_count = TertiaryInstitution::all()->unique('state')->values()->all();

        $lga_count = TertiaryInstitution::all()->unique('local_government')->values()->all();

        title('Admin - All Tertiary Institutions');

        return view('livewire.admin.tertiary-institution.index', [
            'tertiary_institutions' => $tertiary_institutions,
            'states' => $states,
            'local_governments' => $local_governments,
            'towns' => $towns,
            'tertiary_institution_count' => $tertiary_institution_count,
            'state_count' => $state_count,
            'lga_count' => $lga_count,
        ])
            ->extends('layouts.admin')
            ->section('content');
    }
}
