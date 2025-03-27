<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'events';
    protected $fillable = ['id', 'description', 'status','event_start_date','event_end_date','event_start_time','start_end_time','event_topic','created_by','updated_by'];
    protected $keyType = 'string';
    public $incrementing = false;
}
