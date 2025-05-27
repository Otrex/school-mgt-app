<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'content',
        'category',
        'keywords',
        'image',
        'is_publish',
        'tags',
        'slug',
    ];

    protected $casts = ['is_publish' => 'boolean'];

    protected $with = ['admin'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
