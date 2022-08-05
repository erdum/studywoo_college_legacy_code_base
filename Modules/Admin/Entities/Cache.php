<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cache extends Model
{
    use HasFactory;
   // use SoftDeletes;

    protected $fillable = ['slug', 'data'];
}
