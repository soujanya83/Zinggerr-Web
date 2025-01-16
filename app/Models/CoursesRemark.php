<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursesRemark extends Model
{
    protected $table = 'courses_remarks';
    protected $fillable = ['id', 'courses_id', 'users_id','remarks'];
    protected $keyType = 'string';
    public $incrementing = false;

}
