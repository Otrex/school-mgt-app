<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'score',
        'grade'
    ];

    protected $with = ['exam'];

    public function examResultable()
    {
        return $this->morphTo(Community::class, 'exam_resultable_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}