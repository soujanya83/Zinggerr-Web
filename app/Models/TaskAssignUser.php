<?php

namespace App\Models;
use App\Models\TaskModel;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class TaskAssignUser extends Model
{
    protected $table = 'task_assign_users';

    protected $fillable = ['id', 'task_completed_date','task_id','user_id','updated_by','created_by','role_id','course_id'];
    protected $keyType = 'string';
    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function task() {
        return $this->belongsTo(TaskModel::class, 'task_id');
    }
}
