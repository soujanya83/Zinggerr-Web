<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersPermission extends Model
{
    protected $table = 'user_permissions';

    protected $fillable = ['id', 'user_id', 'permission_id'];
    protected $keyType = 'string';
    public $incrementing = false;
}
