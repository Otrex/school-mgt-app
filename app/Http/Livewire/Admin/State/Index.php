<?php

namespace App\Http\Livewire\Admin\State;

use App\Models\State;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function delete($id)
    {
        if (isset($id)) {
            $state = State::find($id);

            $state->delete();

            $this->dispatchBrowserEvent('success', 'State deleted successfully!');
        }
    }

    public function render()
    {
        $state_count = State::count();

        $search = State::query();

        $states = $search->where(function($query) {
            $query->where('name', 'like', '%'.$this->search.'%');
        })
        ->paginate();

        title('Admin - All States');

        return view('livewire.admin.state.index', compact('states', 'state_count'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
