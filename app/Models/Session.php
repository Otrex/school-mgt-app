<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'session',
        'start_date',
        'end_date',
        'default',
    ];

    protected $casts = [
        'default' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
