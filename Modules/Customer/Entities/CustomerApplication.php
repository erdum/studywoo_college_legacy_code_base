<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\College\Entities\College;
use Modules\College\Entities\Course;

class CustomerApplication extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function college(){
        return $this->belongsTo(College::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

}
