<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerEducationalDetail extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = [
        'tenth_passing_year', 'tenth_grading_system', 'tenth_marks',
        'twelve_passing_year', 'twelve_grading_system', 'twelve_marks',
        'grad_passing_year', 'grad_grading_system', 'grad_marks',
        'detail','customer_id'
    ];



}
