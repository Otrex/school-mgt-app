<?php

namespace App\Http\Livewire\Admin\CourseCategory;

use App\Models\CourseCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function delete($id)
    {
        if (isset($id)) {
            $course = CourseCategory::find($id);

            $course->delete();

            $this->dispatchBrowserEvent('closeModal', ['id' => $id]);

            $this->dispatchBrowserEvent('success', 'Course category deleted successfully!');
        }
    }

    public function render()
    {
        $search = CourseCategory::query();

        $course_categories = $search->where(function($query) {
            $query->where('name', 'like', '%'.$this->search.'%');
        })->latest()->paginate();

        $course_categories_count = CourseCategory::count();

        title('Admin - All Course Categories');

        return view('livewire.admin.course-category.index', compact('course_categories', 'course_categories_count'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
