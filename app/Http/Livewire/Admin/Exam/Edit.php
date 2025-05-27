<?php

namespace App\Http\Livewire\Admin\Exam;

use Livewire\Component;

class Edit extends Component
{
    public function render()
    {
        title('Admin - Edit Accessment Test');

        return view('livewire.admin.exam.edit')
            ->extends('layouts.admin')
            ->section('content');
    }
}
