<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
  //  use SoftDeletes;

    protected $fillable = [ 'first_name','last_name','email', 'password','permissions'];

}
