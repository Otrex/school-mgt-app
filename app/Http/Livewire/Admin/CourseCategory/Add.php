<?php

namespace App\Http\Livewire\Admin\CourseCategory;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\CourseCategory;

class Add extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|string'
    ];

    public function add()
    {
        $this->validate();

        CourseCategory::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name)
        ]);

        $this->dispatchBrowserEvent('success', 'New course category added');

        $this->reset(['name']);
    }

    public function render()
    {
        title('Admin - Add Course Category');

        return view('livewire.admin.course-category.add')
            ->extends('layouts.admin')
            ->section('content');
    }
}
