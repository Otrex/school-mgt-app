<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        "manager_id",
        "state_id",
        "town_id",
        "address",
        "name",
        'is_active',
        "local_government_id",
        'opening_hours',
        'closing_hours',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function manager()
    {
        return $this->belongsTo(Community::class, 'manager_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function localGovernment()
    {
        return $this->belongsTo(LocalGovernment::class, 'local_government_id');
    }

    public function town()
    {
        return $this->belongsTo(Town::class, 'town_id');
    }

    public function communityResources()
    {
        return $this->hasMany(CommunityResource::class);
    }
}
