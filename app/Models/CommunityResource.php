<?php

namespace App\Models;

use App\Enums\ResourceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'community_center_id',
        'serial_number',
        'image',
        'description',
        'status',
        'type_id',
        'max_usage_time',
    ];

    public function type()
    {
        return $this->belongsTo(ResourceType::class);
    }

    public function communityCenter()
    {
        return $this->belongsTo(CommunityCenter::class);
    }

    public function setStatus($value)
    {
        $this->attributes['status'] = in_array($value, ResourceStatus::getValues()) ? $value : null;
    }

    public function logs()
    {
        return $this->hasMany(CommunityResourceLog::class, 'resource_id');
    }

    public function waitList()
    {
        return $this->hasMany(CommunityResourceWaitList::class, 'resource_id');
    }
}