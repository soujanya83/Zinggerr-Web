<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseUserPermission extends Model
{

    protected $table = 'courses_user_permissions';
    protected $fillable = ['permission_id', 'assign_user_id', 'id','user_id','course_id'];
    protected $keyType = 'string';
    public $incrementing = false;
}
