<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory;
   // use SoftDeletes;

    protected $fillable = ['question', 'answer' ,'active_status' , 'seo_id'];


}
