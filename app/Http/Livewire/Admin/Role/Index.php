<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $search;

    public function render()
    {
        $admin_count = Admin::count();

        $active = Admin::where('status', 'active')->count();

        $inactive = Admin::where('status', 'suspended')->count();

        $search = Admin::query()->with('roles');

        $admins = $search->where(function($query) {
            $query->where('email', 'like', $this->search.'%')
            ->orWhere('first_name', 'like', $this->search.'%')
            ->orWhere('last_name', 'like', $this->search.'%')
            ->orWhere('level', 'like', $this->search.'%')
            ->orWhere('status', 'like', $this->search.'%');
        })
        ->paginate();

        title('Admin - All Admin');

        return view('livewire.admin.role.index', [
                'admins' => $admins,
                'admin_count' => $admin_count,
                'active' => $active,
                'inactive' => $inactive,
            ])
            ->extends('layouts.admin')
            ->section('content');
    }
}
