<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state',
        'state_id',
        'local_government',
        'local_government_id',
        'town',
        'town_id',
    ];

    public static function filter(?string $state, ?string $local_government, ?string $town)
    {
        $schools = null;
        $filter = self::query();

        // filter by state
        if (isset($state)) {
            $schools = $filter->where('state', 'like', "%$state%");
        }

        // filter by local government
        if (isset($local_government)) {
            $schools = $filter->where('local_government', 'like', "%$local_government%");
        }

        // filter by town
        if (isset($town)) {
            $schools = $filter->where('town', 'like', "%$town%");
        }

        if (isset($state) || isset($local_government) || isset($town)) {
            $schools = $filter->latest()->paginate();
        }

        return $schools;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function communities()
    {
        return $this->hasMany(Community::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function localGovernment()
    {
        return $this->belongsTo(LocalGovernment::class);
    }

    public function town()
    {
        return $this->belongsTo(Town::class);
    }
}
