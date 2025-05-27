<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\User;
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
            $student = User::find($id);

            $student->delete();

            $this->dispatchBrowserEvent('success', 'Student deleted successfully!');
        }
    }

    public function render()
    {
        $all_student_count = User::count();
        $male_student_count = User::where('gender', 'male')->count();
        $female_student_count = User::where('gender', 'female')->count();

        $search = User::query();

        $students = $search->where(function($query) {
            $query->where('first_name', 'like', '%'.$this->search.'%')
            ->orWhere('last_name', 'like', '%'.$this->search.'%')
            ->orWhere('school', 'like', '%'.$this->search.'%')
            ->orWhere('reg_no', 'like', '%'.$this->search.'%');
        })
        ->latest()
        ->paginate();

        title('Admin - All Students');

        return view('livewire.admin.student.index', compact(
                'all_student_count',
                'male_student_count',
                'female_student_count',
                'students'
            ))
            ->extends('layouts.admin')
            ->section('content');
    }
}
