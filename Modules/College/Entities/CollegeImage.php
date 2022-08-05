<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollegeImage extends Model
{
    use HasFactory;
   // use SoftDeletes;

    protected $fillable = ['college_id', 'image_id', 'is_featured','active_status' , 'seo_id'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
