<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'requester_id',
        'center_id',
        'title',
        'reason_for_request',
        'cost',
        'status',
        'resource_id',
        'is_fulfilled'
    ];

    public function requester()
    {
        return $this->belongsTo(Admin::class, 'requester_id');
    }

    public function center()
    {
        return $this->belongsTo(CommunityCenter::class, 'center_id');
    }

    public function resource()
    {
        return $this->belongsTo(CommunityResource::class, 'resource_id');
    }
}