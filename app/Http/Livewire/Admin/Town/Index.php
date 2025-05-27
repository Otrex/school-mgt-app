<?php

namespace App\Http\Livewire\Admin\Town;

use App\Models\Town;
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
            $state = Town::find($id);

            $state->delete();

            $this->dispatchBrowserEvent('success', 'Town deleted successfully!');
        }
    }

    public function render()
    {
        $town_count = Town::count();

        $search = Town::query()->with('localGovernment');

        $towns = $search->where(function($query) {
            $query->where('name', 'like', '%'.$this->search.'%');
        })
        ->paginate();

        title('Admin - All Towns');

        return view('livewire.admin.town.index', compact('towns', 'town_count'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
