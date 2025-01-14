<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursesAssets extends Model
{
    use HasFactory;
    protected $table = 'courses_assets';

    protected $fillable = ['id', 'blog_name', 'course_id', 'course_assets_video', 'chapter_id', 'blogstatus', 'no_of_blog', 'topic_image', 'video_links', 'assets_discription', 'topic_name'];
    protected $keyType = 'string';
    public $incrementing = false;
}
