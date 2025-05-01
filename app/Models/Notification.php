<?php

namespace App\Models;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification as BaseNotification;
use Illuminate\Database\Eloquent\Model;
class Notification extends BaseNotification
{
    protected $table = 'notifications';
    protected $guarded = [];
    protected $casts = [
        'data' => 'array',
    ];
}
