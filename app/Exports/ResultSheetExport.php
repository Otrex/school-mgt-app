<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ResultSheetExport implements FromView
{
    use Exportable;

    public function __construct(protected $student, protected $course_id)
    {
    }

    public function view(): View
    {
        return view('exports.result-template', [
            'students' => $this->student,
            'course_id' => $this->course_id,
        ]);
    }
}
