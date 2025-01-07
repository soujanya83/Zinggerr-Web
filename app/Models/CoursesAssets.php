<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursesAssets extends Model
{
    use HasFactory;
    protected $table = 'courses_assets';

    protected $fillable = ['id', 'blog_name', 'course_id', 'course_assets_video'];
    protected $keyType = 'string';
    public $incrementing = false;
}
