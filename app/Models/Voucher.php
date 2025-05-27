<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'code',
        'is_used',
    ];

    protected $casts = ['is_used' => 'boolean'];

    public function voucherable()
    {
        return $this->morphTo();
    }
}
