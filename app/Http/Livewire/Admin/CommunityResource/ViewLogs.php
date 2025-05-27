<?php

namespace App\Http\Livewire\Admin\CommunityResource;

use Livewire\Component;
use App\Models\CommunityResource;
use App\Models\CommunityResourceLog;
use Livewire\WithPagination;

class ViewLogs extends Component
{
    use WithPagination;

    public $search;
    public CommunityResource $resource;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render()
    {
        $search = CommunityResourceLog::query();
        $total = CommunityResourceLog::where('resource_id', $this->resource->id)->count();

        $logs = $search->whereHas('resource', function($query) {
                $query->whereHas('type', function($typeQuery) {
                    $typeQuery->where('name', 'like', '%'.$this->search.'%');
                });
            })
            ->where('resource_id', $this->resource->id)
            ->latest()
            ->paginate();

        title('Admin - View Resource Logs');

        return view('livewire.admin.community-resource.logs', [
            'logs' => $logs,
            'total' => $total,
            'resource' => $this->resource,
        ])
            ->extends('layouts.admin')
            ->section('content');
    }
}