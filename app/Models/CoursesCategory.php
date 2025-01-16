<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursesCategory extends Model
{
    protected $table='courses_category';
    protected $fillable = ['id','name','description','display_name'];
}
