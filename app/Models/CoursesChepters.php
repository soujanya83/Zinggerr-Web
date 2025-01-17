<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursesChepters extends Model
{
    protected $table = 'courses_chapters';

    protected $fillable = ['id', 'courses_id', 'chepter_name', 'chepter_discription','no_of_chepter','status','mode'];
    protected $keyType = 'string';
    public $incrementing = false;
}
