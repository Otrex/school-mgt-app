<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    // protected $table = 'referral';

    protected $fillable = [
        'owner_id',
        'referred_id',
        'message',
        'honoured'
    ];

    protected $with = ['owner', 'referred'];

    public function owner()
    {
        return $this->belongsTo(Community::class, 'owner_id');
    }

    public function referred()
    {
        return $this->belongsTo(Community::class, 'referred_id');
    }

}
