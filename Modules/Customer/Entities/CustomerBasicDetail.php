<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerBasicDetail extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = [];

}
