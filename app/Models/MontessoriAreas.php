<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MontessoriAreas extends Model
{
    protected $table = 'montessori_areas';
    protected $fillable = ['id','created_by','updated_by','age_group','description','status','full_name','short_name','slug'];
    protected $keyType = 'string';
    public $incrementing = false;
}
