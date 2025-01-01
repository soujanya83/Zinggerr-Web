<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_full_name',
        'course_short_name',
        'course_category',
        'course_start_date',
        'course_end_date',
        'course_id_number',
        'course_status',
        'downloa_status',
        'course_summary',
        'course_image',
        'hidden_section',
        'course_layout',
        'course_sections',
        'force_theme',
        'force_language',
        'no_announcements',
        'gradebook_student',
        'activity_report',
        'activity_date',
        'file_uploads_size',
        'completion_tracking',
        'activity_completion_conditions',
        'group_mode',
        'force_group_mode',
        'default_group',
        'course_format',
        'tags',
        'module_credit',
    ];


    protected $keyType = 'string'; // This tells Laravel that the primary key is a string (UUID).
    public $incrementing = false;
}
