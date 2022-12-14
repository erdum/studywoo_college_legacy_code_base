<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminsRoles extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql2';
    
    protected $fillable = [
        'roles',
        'permissions'
    ];
}
