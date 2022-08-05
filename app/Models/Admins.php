<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

use Modules\College\Entities\CollegeSubpage;

class Admins extends Authenticatable
{
    use HasFactory, HasApiTokens;
    
    protected $connection = 'mysql2';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'status',
        'avatar',
        'author_data',
        'provider_id'
    ];
    
    public static function check($id)
    {
        if (Admins::where('id', $id)->first()) {
            return true;
        }
        
        return false;
    }
    
    public static function author()
    {
        return Admins::where('id', 7)->first();
    }
    
    public function profile()
    {
        return json_decode($this->author_data);
    }
    
    public function subpages()
    {
        return $this->setConnection('mysql')->hasMany(CollegeSubpage::class, 'created_by')->where('slug', 'info')->whereNotNull('meta_title')->orderBy('updated_at', 'asc');
    }
    
}
