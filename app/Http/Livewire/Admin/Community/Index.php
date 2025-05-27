<?php

namespace App\Http\Livewire\Admin\Community;

use Livewire\Component;
use App\Models\Community;
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
            $student = Community::find($id);

            $student->delete();

            $this->dispatchBrowserEvent('success', 'Community member deleted successfully!');
        }
    }

    public function render()
    {
        $all_member_count = Community::count();
        $male_member_count = Community::where('gender', 'male')->count();
        $female_member_count = Community::where('gender', 'female')->count();

        $search = Community::query();

        $members = $search->where(function($query) {
            $query->where('first_name', 'like', '%'.$this->search.'%')
            ->orWhere('last_name', 'like', '%'.$this->search.'%');
        })
        ->latest()
        ->paginate();

        title('Admin - All Community Members');

        return view('livewire.admin.community.index', [
            'all_member_count' => $all_member_count,
            'male_member_count' => $male_member_count,
            'female_member_count' => $female_member_count,
            'members' => $members,
        ])
            ->extends('layouts.admin')
            ->section('content');
    }
}
