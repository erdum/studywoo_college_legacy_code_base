<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;
// use Modules\Admin\Entities\Admin;
// use Modules\Admin\Entities\Seo;

use App\Models\Admins;

class CollegeSubpage extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = ["title", "slug", "content", "type", "college_id", 'active_status', 'seo_id', 'created_by', 'meta_title', 'meta_description', 'tab_name'];

    public function author()
    {
        return $this->belongsTo(Admins::class, "created_by");
    }

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, "seoable");
    }
    
}
