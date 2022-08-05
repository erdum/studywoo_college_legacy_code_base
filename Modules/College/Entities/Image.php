<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
   // use SoftDeletes;

    protected $fillable = ['path', 'filename', 'is_feature' ,'active_status' , 'seo_id'];

    public function getImageUrlAttribute(){
        return $this->path . '/' . $this->filename;
    }
}
