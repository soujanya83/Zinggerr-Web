<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';
    protected $fillable = ['permission_id', 'role_id', 'id','user_id'];
    protected $keyType = 'string';
    public $incrementing = false;
}
