<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskAssignUser extends Model
{
    protected $table = 'task_assign_users';

    protected $fillable = ['id', 'task_completed_date','task_id','user_id','updated_by'];
    protected $keyType = 'string';
    public $incrementing = false;
}
