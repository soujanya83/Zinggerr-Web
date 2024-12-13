<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
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
}
