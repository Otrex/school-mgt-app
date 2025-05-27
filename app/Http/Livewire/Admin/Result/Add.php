<?php

namespace App\Http\Livewire\Admin\Result;

use App\Models\User;
use App\Models\Course;
use App\Models\Result;
use App\Models\Session;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\ResultsImport;
use App\Exports\ResultSheetExport;
use App\Traits\Utilities;
use Maatwebsite\Excel\Facades\Excel;

class Add extends Component
{
    use WithFileUploads, Utilities;

    public $course;

    public $session;

    public $students;

    public $result_sheet;

    protected $rules = [
        'students.*.fullname' => 'required',
        'students.*.reg_no' => 'required',
        'students.*.school' => 'required',
        'students.*.score' => 'required',
    ];

    public function fetch()
    {
        $this->validate(['course' => 'required|string']);

        $result = Result::where(
            [
                'course_id' => $this->course,
                'session' => $this->session->session
            ])->get();

        if ($result->count() > 0) {
            $this->dispatchBrowserEvent('info', 'The result for this course has been added');
        } else {
            $this->students = User::all();
        }
    }

    public function submitResult()
    {
        foreach ($this->students as $student) {
            Result::create([
                'user_id' => $student->id,
                'course_id' => (int)$this->course,
                'session' => $this->session->session,
                'score' => $student->score,
                'grade' => $this->grade($student->score),
            ]);
        }

        $this->reset(['course']);

        $this->dispatchBrowserEvent('success', 'Results uploaded successfully');
    }

    public function exportTemplate()
    {
        return Excel::download(new ResultSheetExport($this->students, $this->course), 'template.xlsx');
    }

    public function bulkUpload()
    {
        $this->validate([
            'result_sheet' => 'required|file|mimes:xlsx',
        ]);

        Excel::import(new ResultsImport, $this->result_sheet);

        $this->dispatchBrowserEvent('success', 'Results uploaded successfully');

        $this->reset(['result_sheet', 'students', 'course']);
    }

    public function render()
    {
        // fetch all available courses
        $courses = Course::all('id','name');

        // current session
        $this->session = Session::where('default', true)->first();

        title('Admin - Add Result');

        return view('livewire.admin.result.add', compact('courses'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
