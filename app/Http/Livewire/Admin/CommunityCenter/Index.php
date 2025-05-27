<?php

namespace App\Http\Livewire\Admin\CommunityCenter;

use Livewire\Component;
use App\Models\Community;
use App\Models\CommunityCenter;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function delete($id)
    {
        if (isset($id)) {
            $student = CommunityCenter::find($id);

            $student->delete();

            $this->dispatchBrowserEvent('success', 'Community center deleted successfully!');
        }
    }

    public function render()
    {

        $search = CommunityCenter::query();
        $total = CommunityCenter::count();

        $centers = $search->where(function($query) {
            $query->where('name', 'like', '%'.$this->search.'%');
        })
            ->latest()
            ->paginate();

        title('Admin - All Community Centers');

        return view('livewire.admin.community-center.index', [
            'centers' => $centers,
            'total' => $total
        ])
            ->extends('layouts.admin')
            ->section('content');
    }
}
