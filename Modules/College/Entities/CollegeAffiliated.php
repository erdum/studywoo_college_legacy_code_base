<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollegeAffiliated extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = ['college_id', 'affiliated_id'];


    public function college()
    {
        return $this->belongsToMany(College::class);
    }
}
