<?php

namespace App\Http\Livewire\Admin\LocalGovernment;

use App\Models\LocalGovernment;
use App\Models\State;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $state;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function resetFilter()
    {
        $this->reset(['state']);
    }

    public function search()
    {
        $search = LocalGovernment::query()->with('state');

        $local_governments = $search->where(function($query) {
            $query->where('name', 'like', '%'.$this->search.'%');
        })
        ->latest()
        ->paginate();

        return $local_governments;
    }

    public function render()
    {
        $filter = LocalGovernment::filter($this->state);

        $local_governments = is_null($filter) ? $this->search() : $filter;

        $local_government_count = LocalGovernment::count();

        $states = State::all();

        title('Admin - All Local Government Areas');

        return view('livewire.admin.local-government.index', [
            'local_governments' => $local_governments,
            'local_government_count' => $local_government_count,
            'states' => $states,
        ])
            ->extends('layouts.admin')
            ->section('content');
    }
}
