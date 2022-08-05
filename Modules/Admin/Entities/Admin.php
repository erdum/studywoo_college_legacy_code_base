<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\College\Entities\CollegeSubpage;

// Main Admins Model
use App\Models\Admins;

class Admin extends Admins
{
    use HasFactory;

    public function adminDetail()
    {
        return $this->hasOne(AdminDetail::class);
    }

    public function subpages(){
        return $this->hasMany(CollegeSubpage::class , 'created_by');
    }

}
