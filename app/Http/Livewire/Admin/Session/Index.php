<?php

namespace App\Http\Livewire\Admin\Session;

use App\Models\Session;
use Livewire\Component;

class Index extends Component
{
    public $search;

    public function render()
    {
        $session_count = Session::count();

        $search = Session::query();

        $sessions = $search->where(function($query) {
            $query->where('session', 'like', $this->search.'%')
            ->orWhere('start_date', 'like', $this->search.'%')
            ->orWhere('end_date', 'like', $this->search.'%');
        })
        ->latest()
        ->paginate();

        title('Admin - All Sessions');

        return view('livewire.admin.session.index', compact('session_count', 'sessions'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
