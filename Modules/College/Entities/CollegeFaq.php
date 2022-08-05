<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollegeFaq extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = ['college_id','faq_id'];

    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }


}
