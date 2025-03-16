<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MontessoriAgeGroup extends Model
{
    protected $table = 'montessori_age_groups';
    protected $fillable = ['id','created_by','updated_by','description','status','montessori_areas_id','full_name','short_name','slug'];
    protected $keyType = 'string';
    public $incrementing = false;
}
