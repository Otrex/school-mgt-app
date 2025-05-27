<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Admin;
use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Add extends Component
{
    public $first_name;

    public $last_name;

    public $email;

    public $level;

    public $role;

    public $status;

    public $password;

    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email|unique:admins',
        'password' => 'required|string|min:8',
        'status' => 'required|string',
        'level' => 'required|numeric',
        'role' => 'required',
    ];

    public function add()
    {
        $this->validate();

        // create new admin
        $admin = Admin::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'status' => $this->status,
            'level' => (int) $this->level,
        ]);

        $admin->roles()->attach($this->role);

        $this->dispatchBrowserEvent('success', 'New admin added successfully');

        // reset the form
        $this->reset([
            'first_name',
            'last_name',
            'email',
            'password',
            'status',
            'level',
        ]);
    }

    public function render()
    {
        $roles = Role::all();

        title('Admin - Add New Admin');

        return view('livewire.admin.role.add', compact('roles'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
