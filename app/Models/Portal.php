<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portal extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'is_on',
    ];

    protected $casts = ['is_on' => 'boolean'];
}
