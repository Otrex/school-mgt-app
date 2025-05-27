<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finish extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'course_series_id',
        'serial_no',
        'status'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function finishable()
    {
        return $this->morphTo();
    }
}
