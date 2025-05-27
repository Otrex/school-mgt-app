<?php

namespace App\Http\Livewire\Admin\Exam;

use App\Models\Exam;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        if (isset($id)) {

            $exam = Exam::find($id);

            $exam->delete();

            $this->dispatchBrowserEvent('success', 'Exam deleted successully!');
        }
    }

    public function render()
    {
        $exam_count = Exam::count();

        $exams = Exam::latest()->paginate();

        title('Admin - All Accessment Test');

        return view('livewire.admin.exam.index', compact('exams', 'exam_count'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
