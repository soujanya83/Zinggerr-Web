<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    protected $table = 'courses_weekly_sections';

    protected $fillable = ['id', 'course_id', 'date','assetstype','status','blog','url','youtube','video'];
    protected $keyType = 'string';
    public $incrementing = false;
}
