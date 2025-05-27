<?php

namespace App\Http\Livewire\Admin;

use App\Models\Blog;
use App\Models\Community;
use App\Models\User;
use App\Models\Course;
use App\Models\Result;
use App\Models\Session;
use Livewire\Component;
use Illuminate\Support\{Arr, Str};

class Dashboard extends Component
{
    public function render()
    {
        $courses = Course::count();

        $students = User::count();

        $community_members = Community::count();

        $blogs = Blog::where('is_publish', true)->latest()->limit(5)->get();

        $current_session = Session::where('default', true)->first()->session;

        $best_results = [];

        if (Result::where('session', $current_session)->get()->count() > 0) {
            $results = Result::all()->where('session', $current_session)->groupBy('user_id');

            foreach ($results as $index => $result)
                $best_results[$index] = $result->sum('score')/$result->count();

            arsort($best_results);
        }

        title('Admin - Dashboard');

        return view('livewire.admin.dashboard', compact(
                'courses', 'students',
                'blogs', 'best_results',
                'current_session',
                'community_members'
            ))
            ->extends('layouts.admin')
            ->section('content');
    }
}
