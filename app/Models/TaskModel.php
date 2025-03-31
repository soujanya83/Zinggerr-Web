<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    protected $table = 'task';

    protected $fillable = ['id', 'task_title','task_completion_date','description','created_by','updated_by','status'];
    protected $keyType = 'string';
    public $incrementing = false;
}
