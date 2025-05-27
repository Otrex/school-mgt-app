<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'parent_category_id'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function subCategories()
    {
        return $this->hasMany(CourseCategory::class, 'parent_category_id');
    }
}