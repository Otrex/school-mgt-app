<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'phone',
        'password',
        'school',
        'school_id',
        'reg_no',
        'session_id',
        'state',
        'state_id',
        'local_government',
        'local_government_id',
        'town',
        'town_id',
        'home_address',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['session', 'school'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['fullname', 'initial'];

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    /**
     * Get the student's fullname.
     *
     */
    public function getFullNameAttribute() : string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the student's fullname initials.
     *
     */
    public function getInitialAttribute() : string
    {
        return strtoupper("{$this->first_name[0]}{$this->last_name[0]}");
    }

    public function vouchers()
    {
        return $this->morphMany(Voucher::class, 'voucherable');
    }

    public function finishes()
    {
        return $this->morphMany(Finish::class, 'finishable');
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function answers()
    {
        return $this->morphMany(Answer::class, 'answerable');
    }

    public function attempts()
    {
        return $this->morphMany(Attempt::class, 'attemptable');
    }

    public function examResults()
    {
        return $this->morphMany(ExamResult::class, 'exam_resultable');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function localGovernment()
    {
        return $this->belongsTo(LocalGovernment::class);
    }

    public function town()
    {
        return $this->belongsTo(Town::class);
    }
}
