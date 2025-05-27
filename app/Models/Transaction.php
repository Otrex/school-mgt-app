<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        "amount",
        "status",
        "ref",
        "source",
        "type",
        "description",
        "member_id",
        "parent_id"
    ];

    public function parentTransaction()
    {
        return $this->belongsTo(Transaction::class, 'parent_id');
    }

    public function member()
    {
        return $this->belongsTo(Community::class);
    }
}