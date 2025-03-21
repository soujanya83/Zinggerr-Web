<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;


    protected $fillable = [
        'id',
        'name',
        'slug',
        'user_id',
        'username',
        'country_name',
        'email',
        'country_code',
        'phone',
        'status',
        'reset_password_status',
        'password',
        'gender',
        'phone_verified_at',
        'type',
        'token',
        'email_verified_at',
        'remember_token',
        'profile_picture',
        'created_at'
    ];

    protected $keyType = 'string'; // This tells Laravel that the primary key is a string (UUID).
    public $incrementing = false;
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new VerifyEmailNotification());
    // }
}
