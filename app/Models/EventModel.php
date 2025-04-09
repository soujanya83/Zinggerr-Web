<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'events';
    protected $fillable = ['id', 'description', 'status','event_start','event_end','event_topic','created_by','updated_by','background_color','text_color'];
    protected $keyType = 'string';
    public $incrementing = false;
}
