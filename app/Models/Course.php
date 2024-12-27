<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'start_date',
        'duration',
        'price',
        'teacher_name',
        'max_students',
        'status',
        'details'
    ];

    protected $keyType = 'string'; // This tells Laravel that the primary key is a string (UUID).
    public $incrementing = false;
}
