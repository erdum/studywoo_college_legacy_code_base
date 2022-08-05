<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CollegeContact extends Model
{
    use HasFactory;

    protected $fillable = ['contact_number','college_id'];


}
