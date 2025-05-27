<?php

namespace App\Http\Livewire\Admin\CourseCategory;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\CourseCategory;

class Edit extends Component
{
    public CourseCategory $category;

    protected $rules = ['category.name' => 'required|string'];

    public function save()
    {
        $this->validate();

        $this->category->slug = Str::slug($this->category->name);

        $this->category->save();

        $this->dispatchBrowserEvent('success', 'Course category updated successfully!');
    }

    public function render()
    {
        title('Admin - Edit Course Category');

        return view('livewire.admin.course-category.edit')
            ->extends('layouts.admin')
            ->section('content');
    }
}
