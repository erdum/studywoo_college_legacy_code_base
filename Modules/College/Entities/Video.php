<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory;
   // use SoftDeletes;

    protected $fillable = ['title','url','seo_id','active_status'];



}
