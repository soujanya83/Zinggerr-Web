<?php

namespace App\Models;

use App\Notifications\VerifyEmailNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;


    protected $fillable = [
        'id',
        'name',
        'username',
        'email',
        'phone',
        'status',
        'password',
        'gender',
        'type',
        'token',
        'email_verified_at',
        'remember_token',
        'profile_picture'
    ];

    protected $keyType = 'string'; // This tells Laravel that the primary key is a string (UUID).
    public $incrementing = false;
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

}
