<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InteractiveAsset extends Model
{
    protected $table = 'interactive_assets';
    protected $fillable = ['video_id', 'asset_id', 'checkpoint_time','user_id','id'];
    protected $keyType = 'string';
    public $incrementing = false;
}
