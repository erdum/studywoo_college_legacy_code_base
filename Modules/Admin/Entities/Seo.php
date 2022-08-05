<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seo extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = ["meta_title", "meta_description", "meta_keyword"];

    public function seoable(){
        return $this->morphTo();
    }
}
