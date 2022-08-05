<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminDetail extends Model
{
    use HasFactory;
   // use SoftDeletes;

    protected $fillable = [
        'first_name', 'avatar', 'admin_id', 'last_name', 'emailAddress', 'phone',
        'gender', 'date_of_birth', 'facebook', 'twitter', 'instagram', 'linkedin',
        'github', 'skype', 'details', 'permissions'
    ];


    public function getFullNameAttribute(){
        return $this->first_name . " " . $this->last_name;
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function seo(){
        return $this->morphOne(Seo::class,'seoable');
    }


}
