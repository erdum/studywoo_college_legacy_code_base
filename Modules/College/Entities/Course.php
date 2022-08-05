<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = ['name', 'slug' ,'active_status' , 'seo_id'];

    public function scopeGetFilterList($query)
    {
        return $query->select('name', 'slug', 'id')->get();
    }

    public function colleges()
    {
        return $this->belongsToMany(College::class , CollegeCourse::class);
    }
    
    public static function getCoursesByStream($stream)
    {
        return self::where('name', 'LIKE', "%{$stream}%")->limit(10)->get()->unique('name');
    }
}
