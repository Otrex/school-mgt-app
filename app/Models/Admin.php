<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admin';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'level',
        'status',
    ];

    protected $hidden = ['password'];

    protected $appends = ['fullname'];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * Get the admin's fullname.
     *
     */
    public function getFullNameAttribute() : string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
