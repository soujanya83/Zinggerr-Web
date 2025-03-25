<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';
    protected $fillable = ['permission_id', 'id','role_id','user_id','created_by','updated_by'];
    protected $keyType = 'string';
    public $incrementing = false;
}
