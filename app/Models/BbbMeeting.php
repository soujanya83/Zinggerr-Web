<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BbbMeeting extends Model
{
    protected $table = 'meetings';

    protected $fillable = ['id', 'meeting_id', 'meeting_name', 'moderator_pw', 'attendee_pw','scheduled_at','status','moderator_join_url','attendee_join_url'];
    protected $keyType = 'string';
    public $incrementing = false;
    protected $casts = [
        'scheduled_at' => 'datetime',
    ];
}
