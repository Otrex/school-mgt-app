<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'question_id',
        'option_question_id',
        'answer',
        'is_final',
    ];

    protected $with = ['question'];

    protected $casts = ['is_final' => 'boolean'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }


    public function optionQuestion()
    {
        return $this->belongsTo(OptionQuestion::class);
    }

    public function answerable()
    {
        return $this->morphTo();
    }
}
