<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerComment extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = ['customer_id','college_id','comment','parent_id'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
