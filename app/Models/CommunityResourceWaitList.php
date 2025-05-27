<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class CommunityResourceWaitList extends Model
{
    use HasFactory;

    protected $fillable = [

        'member_id',

        'resource_id',

        'no_of_notified_times'

    ];

    public function member()
    {
        return $this->belongsTo(Community::class, 'member_id');
    }

    public function resource()
    {
        return $this->belongsTo(CommunityResource::class, 'resource_id');
    }
}
