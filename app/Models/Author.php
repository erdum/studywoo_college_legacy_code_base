<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admins;

class Author extends Model
{
    use HasFactory;
    
    public static function get()
    {
        return Admins::find(env('AUTHOR_ID'));
    }
    
}
