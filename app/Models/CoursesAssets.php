<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursesAssets extends Model
{
    use HasFactory;
    protected $table = 'courses_assets';

    protected $fillable = ['id', 'topic_name', 'course_id', 'assets_video', 'chapter_id','assets_type','status', 'images', 'video_url', 'blog_description','youtube_links'];
    protected $keyType = 'string';
    public $incrementing = false;
}
