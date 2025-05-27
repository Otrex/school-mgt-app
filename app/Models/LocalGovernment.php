<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalGovernment extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_id',
        'name',
    ];

    public function towns()
    {
        return $this->hasMany(Town::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
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

    public static function filter(?int $state_id)
    {
        $states = null;

        $filter = self::query();

        if(isset($state_id))
            $states = $filter->where('state_id', $state_id)->paginate();

        return $states;
    }
}
