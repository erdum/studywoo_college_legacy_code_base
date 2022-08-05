<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollegeCourse extends Model
{
    use HasFactory;
   // use SoftDeletes;

    protected $fillable = ['college_id', 'course_id', 'duration', 'course_type_id', 'entrance_exam_id', 'description', 'active_status', 'price', 'seo_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function entranceExam()
    {
        return $this->belongsTo(EntranceExam::class);
    }

    public function type()
    {
        return $this->belongsTo(CourseType::class, 'course_type_id');
    }
    
    public function college()
    {
        return $this->belongsToMany(College::class);
    }
}
