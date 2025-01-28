<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    protected $table = 'courses_sections';

    protected $fillable = ['id', 'courses_id', 'course_start_date', 'sections_remark_date','sections_remark','status'];
    protected $keyType = 'string';
    public $incrementing = false;
}
