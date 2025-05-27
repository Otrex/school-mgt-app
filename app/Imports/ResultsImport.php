<?php

namespace App\Imports;

use App\Models\Result;
use App\Traits\Utilities;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResultsImport implements ToModel, WithHeadingRow
{
    use Utilities;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Result([
            'user_id' => $row['student_id'],
            'course_id' => $row['course_id'],
            'session' => $row['session'],
            'score' => $row['score'],
            'grade' => $this->grade($row['score']),
        ]);
    }
}
