<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollegeDetails extends Model
{
    use HasFactory;
   // use SoftDeletes;

    protected $fillable = ['college_id', 'logo', 'estd', 'state_id', 'city_id', 'active_status', 'seo_id', 'location', 'website', 'college_type_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function affiliated()
    {
        return $this->belongsTo(Affiliated::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function type()
    {
        return $this->belongsTo(CollegeType::class, "college_type_id");
    }

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function logo()
    {
        return $this->belongsTo(Image::class);
    }
}
