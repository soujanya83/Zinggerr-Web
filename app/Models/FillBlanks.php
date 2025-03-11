<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FillBlanks extends Model
{
    protected $table = 'fillblanks';

    protected $fillable = ['id', 'course_id','chapter_id','video_name','video_time','instructions','sentence','answers','skippable','position_x','position_y'];
    protected $keyType = 'string';
    public $incrementing = false;
}
 