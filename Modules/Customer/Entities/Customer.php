<?php

namespace Modules\Customer\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admin\Entities\Otp;

class Customer extends Authenticatable
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = ['email', 'password', 'user_name', 'status', 'email_verified_at', 'provider_id'];

    public function customerDetail()
    {
        return $this->hasOne(CustomerDetail::class);
    }

    public function educationalDetail()
    {
        return $this->hasOne(CustomerEducationalDetail::class);
    }

    public function otp(){
        return $this->morphMany(Otp::class,'otpable');
    }


}


