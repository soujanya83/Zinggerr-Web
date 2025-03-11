<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoQuiz extends Model
{
    protected $table = 'video_quizzes';

    protected $fillable = ['id', 'course_id','chapter_id','video_name','quiz_time','quiz_question','option_1','option_2','option_3','option_4','correct_option'];
    protected $keyType = 'string';
    public $incrementing = false;
}
