<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BbbMeeting extends Model
{
    protected $table = 'meetings';

    protected $fillable = ['id', 'meeting_id', 'meeting_name', 'moderator_pw', 'attendee_pw','scheduled_at','status'];
    protected $keyType = 'string';
    public $incrementing = false;
}
