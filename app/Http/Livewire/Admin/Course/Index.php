<?php

namespace App\Http\Livewire\Admin\Course;

use App\Models\Course;
use Livewire\Component;

class Index extends Component
{
    public $search;

    public function delete($id)
    {
        if (isset($id)) {
            $course = Course::find($id);

            $course->delete();

            $this->dispatchBrowserEvent('success', 'Course deleted successfully!');
        }
    }

    public function render()
    {
        $course_count = Course::count();
        $category_count = Course::all()->unique('course_category_id')->values()->all();
        $search = Course::query()->with('courseSeries');

        $courses = $search->where(function($query) {
            $query->where('name', 'like', $this->search.'%');
        })
        ->latest()
        ->paginate();

        title('Admin - All Programs');

        return view('livewire.admin.course.index', compact(
                'course_count',
                'category_count',
                'courses'
            ))
            ->extends('layouts.admin')
            ->section('content');
    }
}