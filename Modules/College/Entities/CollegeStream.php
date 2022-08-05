<?php

namespace Modules\College\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollegeStream extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = ['college_id', 'stream_id'];


    public function scopeGetFilterList($query)
    {
        return $query->select('college_id', 'stream_id')->get();
    }
    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }
    public function college()
    {
        return $this->belongsTo(College::class);
    }
}
