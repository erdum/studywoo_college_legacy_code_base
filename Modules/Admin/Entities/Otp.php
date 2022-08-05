<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otp extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['otpable_type','otpable_id','code'];

    public function otpable(){
        return $this->morphTo();
    }
}
