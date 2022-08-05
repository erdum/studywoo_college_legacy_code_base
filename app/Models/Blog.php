<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admins;
use App\Models\Pages;
use App\Models\Comments;
use App\Models\Reviews;
use App\Models\Faq;

class Blog extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql2';
    
    protected $fillable = [
        'title',
        'slug',
        'posted_by',
        'meta_title',
        'meta_description',
        'body',
        'visits',
        'cover_image'
    ];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function user()
    {
        return $this->belongsTo(Admins::class, 'posted_by', 'id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comments::class, 'posted_on', 'slug');
    }
    
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'posted_on', 'slug');
    }
    
    public function faqs()
    {
        return $this->hasMany(Faq::class, 'posted_on', 'slug');
    }
    
    public static function get_popular_posts()
    {
        $rows = Blog::orderBy('visits', 'desc')->with('user')->take(5)->get();
        
        foreach ($rows as $row)
        {
            $page_seo = Pages::where('page_id', $row->slug)->first();
            
            if ($page_seo) {
                $page_seo = [$page_seo->title, $page_seo->meta_description];
                $row->title = $page_seo[0];
                $row->meta_description = $page_seo[1];
            }
        }
        
        return $rows;
    }
}
