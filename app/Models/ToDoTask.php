<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDoTask extends Model
{
    protected $table = 'to_do_task';

    protected $fillable = ['id', 'user_id', 'date','task','completed'];
    protected $keyType = 'string';
    public $incrementing = false;
}
