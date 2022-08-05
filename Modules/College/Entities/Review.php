<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = ['college_id', 'fullname', 'star', 'review', 'active_status', 'seo_id'];



}
