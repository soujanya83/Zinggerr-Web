<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['id','name', 'display_name', 'description'];
    protected $keyType = 'string';
    public $incrementing = false;
}
