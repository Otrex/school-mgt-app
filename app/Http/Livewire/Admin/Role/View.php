<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class View extends Component
{
    public Admin $admin;

    public $role;

    protected $rules = [
        'admin.first_name' => 'required|string',
        'admin.last_name' => 'required|string',
        'admin.status' => 'required|string',
        'admin.level' => 'required|numeric',
    ];

    public function save()
    {
        $this->validate();

        $this->admin->save();

        $this->dispatchBrowserEvent('success', 'Admin detail updated successfully!');
    }

    public function assignNewRole()
    {
        $this->validate(['role' => 'required|numeric']);

        $admin_role_count = DB::table('admin_role')
            ->where(['admin_id' => $this->admin->id, 'role_id' => $this->role])
            ->get()->count();

        if($admin_role_count > 0) {
            $this->dispatchBrowserEvent('error', 'This role has already been assigned to this admin');
        } else {
            $this->admin->roles()->attach($this->role);

            $this->dispatchBrowserEvent('success', 'New role assigned successfully!');

            $this->reset(['role']);
        }
    }

    public function render()
    {
        $roles = Role::all();

        $role_description = $this->admin->roles()->first()->description;

        title('Admin - View Admin');

        return view('livewire.admin.role.view', compact('roles', 'role_description'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
