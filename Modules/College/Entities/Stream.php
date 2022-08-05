<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stream extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = ['name', 'slug', 'active_status', 'seo_id'];

    public function colleges()
    {
        return $this->belongsToMany(College::class, CollegeStream::class);
    }

    public function scopeGetFilterList($query)
    {
        return $query->select('name', 'slug', 'id')->get();
    }
}
