<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerReview extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = [
        'college_id', 'customer_id', 'title', 'description',
        'faculty', 'internship', 'interview', 'course', 'hostel',
        'social_life', 'placement', 'average_rating', 'slug'
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function getRelatedReview($int)
    {
        return $this->where("college_id", $this->college_id)->where("id", "!=", $this->id)
            ->limit($int)->get();
    }
}
