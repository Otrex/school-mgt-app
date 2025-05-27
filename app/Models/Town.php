<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
        'local_government_id',
        'name'
    ];

    public function localGovernment()
    {
        return $this->belongsTo(LocalGovernment::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function communities()
    {
        return $this->hasMany(Community::class);
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }
}