<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function localGovernments()
    {
        return $this->hasMany(LocalGovernment::class);
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

    public function tertiaryInstitution()
    {
        return $this->hasMany(TertiaryInstitution::class);
    }
}
