<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityResourceLog extends Model
{
    use HasFactory;

    protected $dates = ['check_in', 'check_out'];

    protected $fillable = [
        'resource_id',
        'action',
        'description',
        'check_in',
        'check_out',
        'owner_id'
    ];

    // Relationship with CommunityResource
    public function resource()
    {
        return $this->belongsTo(CommunityResource::class);
    }

    public function owner()
    {
        return $this->belongsTo(Community::class, 'owner_id');
    }
}