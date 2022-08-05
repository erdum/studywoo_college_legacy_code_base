<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admins;

class Comments extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql2';
    
    protected $fillable = [
        'posted_by',
        'posted_on',
        'body',
        'approved',
    ];
    
    public function user()
    {
        return $this->belongsTo(Admins::class, 'posted_by');
    }
    
    public static function getComments($posted_on)
    {
        return Comments::orderBy('id', 'desc')->where('approved', 1)->where('posted_on', $posted_on)->with('user')->get();
    }
}
