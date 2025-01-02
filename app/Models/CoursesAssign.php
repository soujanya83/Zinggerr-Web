<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursesAssign extends Model
{
   protected $table='courses_assign';
   protected $fillable = ['id','courses_id','users_id'];

   protected $keyType = 'string';
   public $incrementing = false;
}
