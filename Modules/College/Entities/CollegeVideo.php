<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollegeVideo extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = ['college_id','video_id'];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }


}
