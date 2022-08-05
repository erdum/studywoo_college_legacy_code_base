<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\College\Entities\City;

class CustomerDetail extends Model
{
    use HasFactory;
   // use SoftDeletes;

    protected $fillable = ['first_name', 'last_name','phone', 'customer_id', 'gender', 'date_of_birth','city_id','address', 'pincode', 'detail','avatar','state_id'];

    protected $appends=['full_name'];

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

}
