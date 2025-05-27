<?php

namespace App\Http\Livewire\Admin\School;

use App\Models\School;
use App\Traits\LocalGovernmentTown;
use Livewire\Component;
use Livewire\WithPagination;

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
        $search = School::query();

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
            $student = School::find($id);

            $student->delete();

            $this->dispatchBrowserEvent('success', 'School deleted successfully!');
        }
    }

    public function render()
    {
        $filter = School::filter($this->state, $this->local_government, $this->town);

        $schools = is_null($filter) ? $this->search() : $filter;

        $states = $this->states();
        $local_governments = (isset($this->state)) ? $this->localGovernments($this->state) : [];
        $towns = (isset($this->local_government)) ? $this->towns($this->local_government) : [];

        // school count
        $school_count = School::count();

        // Count all states
        $state_count = School::all()->unique('state')->values()->all();

        $lga_count = School::all()->unique('local_government')->values()->all();

        title('Admin - All Schools');

        return view('livewire.admin.school.index', [
                'schools' => $schools,
                'states' => $states,
                'local_governments' => $local_governments,
                'towns' => $towns,
                'school_count' => $school_count,
                'state_count' => $state_count,
                'lga_count' => $lga_count,
            ])
            ->extends('layouts.admin')
            ->section('content');
    }
}
