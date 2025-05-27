<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id'];

    protected $with = ['exam'];

    public function attemptable()
    {
        return $this->morphTo();
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
