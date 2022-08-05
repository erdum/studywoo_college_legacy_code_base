<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
   // use SoftDeletes;

    protected $fillable = ['college_id', 'comment_id', 'fullname', 'comment' ,'active_status' , 'seo_id' ];
}
