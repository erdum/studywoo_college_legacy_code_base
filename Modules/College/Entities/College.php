<?php

namespace Modules\College\Entities;

use Voidgraphics\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\Seo;
use Modules\College\Transformers\CollegeListItem;
use Modules\Customer\Entities\CustomerReview;

use App\Models\Reviews;
use App\Models\Comments;
use App\Models\Faq;

class College extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = ['name', 'slug', 'active_status', 'seo_id', 'location', 'logo', 'website', 'state_id', 'city_id', 'estd', 'logo_path', 'title', 'meta_description', 'info_page'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, CollegeCourse::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, "city_id");
    }

    public function faq()
    {
        return $this->hasMany(CollegeFaq::class);
    }

    public function author()
    {
        return $this->subPage("info")->author;
    }

    public function subPages()
    {
        return $this->hasMany(CollegeSubpage::class);
    }

    public function getSubPages()
    {
        return CollegeSubpage::where('college_id', $this->id)->select('slug', 'title')->get()->toArray();
    }

    public function subPage($slug)
    {
        return CollegeSubpage::where('college_id', $this->id)->where('slug', $slug)->first();
    }

    public function images()
    {
        return $this->hasMany(Image::class, CollegeImage::class, 'college_id', 'image_id',  'id', 'id');
    }

    public function affiliated()
    {
        return $this->belongsToMany(Affiliated::class, CollegeAffiliated::class );
    }

    public function collegeType()
    {
        return $this->belongsToMany(CollegeType::class, CollegeCollegeType::class );
    }

    public function stream()
    {
        return $this->belongsToMany(Stream::class, CollegeStream::class );
    }

    public function entrance()
    {
        return $this->belongsToMany(EntranceExam::class, CollegeEntranceExam::class );
    }

    public function contacts()
    {
        return $this->hasMany(CollegeContact::class);
    }

    public function courseType()
    {
        return $this->belongsToMany(CourseType::class, CollegeCourseType::class );
    }
    
    public function comments()
    {
        return $this->hasMany(Comments::class, 'posted_on', 'slug');
    }
    
    public function faqs()
    {
        return $this->hasMany(Faq::class, 'posted_on', 'slug');
    }
    
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'posted_on', 'slug');
    }
    
    public function getAverageRating()
    {
        $reviews = $this->reviews;
        
        if (count($reviews) > 0) {
            return number_format($reviews->sum('rating') / count($reviews), 1);
        }
        
        return 0;
    }
    
    public static function applyFilters($filters, $paginationNumber = 0, $sortDirection = 'asc')
    {
        $search_query = self::query();

        foreach ($filters as $filter)
        {
            $search_query->whereHas(explode('=', $filter)[0], function ($query) use ($filter) {
                $query->where('name', explode('=', $filter)[1]);
            });
        }
        
        return $search_query
        ->orderBy('name', $sortDirection)
        ->offset($paginationNumber * 10)
        ->limit(10)
        ->get();
    }
    
    public static function getPopularColleges()
    {
        return self::limit(5)->get()->sortBy(function($query) {
            return $query->reviews;
        });
    }
    
    public static function getCollegesWithFilters($category, $keyword)
    {
        $model = sprintf('Modules\College\Entities\%s', ucfirst($category));
        
        $data = $model::whereHas('colleges', function ($value) use ($keyword) {
            $value->whereHas('stream', function ($value) use ($keyword) {
                $value->where('name', $keyword);
            });
        })
        ->distinct()
        ->limit(10)
        ->get();
        
        return $data;
    }

    // public function reviews()
    // {
    //     return $this->hasMany(CustomerReview::class);
    // }

    // public function comments(){
    //     return $this->hasMany(Comment::class);
    // }

    // public function collegeLogo(){
    //     return $this->belongsTo(Image::class,'logo');
    // }

    // public function videos(){
    //     return $this->hasMany(CollegeVideo::class);
    // }

    // public function getAverageFacultyAttribute(){
    //     return $this->reviews()->select('faculty')->avg('faculty');
    // }

    // public function getAverageSocialLifeAttribute(){
    //     return $this->reviews()->select('social_life')->avg('social_life');
    // }

    // public function getAverageInterviewAttribute(){
    //     return $this->reviews()->select('interview')->avg('interview');
    // }

    // public function getAveragePlacementAttribute(){
    //     return $this->reviews()->select('placement')->avg('placement');
    // }

    // public function getAverageInternshipAttribute(){
    //     return $this->reviews()->select('internship')->avg('internship');
    // }

    // public function getAverageHostelAttribute(){
    //     return $this->reviews()->select('hostel')->avg('hostel');
    // }

    // public function getAverageCourseAttribute(){
    //     return $this->reviews()->select('course')->avg('course');
    // }

    // public function getTotalAverageAttribute(){
    //     return $this->reviews()->select('average_rating')->avg('average_rating');
    // }

    // public function featuredImage($isThumb = true)
    // {
    //     $image = CollegeImage::where('college_id', $this->id)->where('is_featured', 1)->first()->image ?? null;
    //     if ($image)
    //         if ($isThumb)
    //             return ($image->path . "/thumb" . "/" . $image->filename);
    //         else return ($image->path . "/feature" . "/" . $image->filename);
    //     return null;
    // }

    // public function seo()
    // {
    //     return $this->morphOne(Seo::class, "seoable");
    // }


    // public static function filterList(Request $request)
    // {

    //     $collegeDetail = CollegeDetails::select("*");

    //     if ($request->stream) {
    //         $ids = CollegeStream::whereIn('stream_id', $request->stream)
    //             ->select('stream_id', 'college_id')->pluck('college_id')->values();
    //         $collegeDetail = $collegeDetail->whereIn('college_id', $ids);
    //     }
    //     if ($request->course_type) {
    //         $ids = CollegeCourse::whereIn('type_id', $request->course_type)
    //             ->select('type_id', 'college_id')->pluck('college_id')->values();
    //         $collegeDetail = $collegeDetail->whereIn('college_id', $ids);
    //     }

    //     if ($request->entrance) {
    //         $ids = CollegeCourse::whereIn('entrance_exam_id', $request->entrance)
    //             ->select('entrance_exam_id', 'college_id')->pluck('college_id')->values();
    //         $collegeDetail = $collegeDetail->whereIn('college_id', $ids);
    //     }

    //     if ($request->courses) {
    //         $ids = CollegeCourse::whereIn('course_id', $request->courses)
    //             ->select('course_id', 'college_id')->pluck('college_id')->values();
    //         $collegeDetail = $collegeDetail->whereIn('college_id', $ids);
    //     }


    //     if ($request->state) {
    //         $collegeDetail = $collegeDetail->whereIn('state_id', $request->state);
    //     }
    //     if ($request->city) {
    //         $collegeDetail = $collegeDetail->whereIn('city_id', $request->city);
    //     }
    //     if ($request->type) {
    //         $collegeDetail = $collegeDetail->whereIn("college_type_id", $request->type);
    //     }
    //     return  $collegeDetail->get();
    // }


    public function getRelatedCollege()
    {
        return $this->where("state_id", $this->state_id)->orWhere("city_id", $this->city_id)->limit(11)->get();
    }


    // public function getReviewCountAttribute()
    // {
    //     return $this->reviews()->count() ?? 0;
    // }

    // public function getAverageRatingAttribute()
    // {
    //     return $this->reviews()->avg("average_rating") ?? 0;
    // }

    // public function getWorstRatingAttribute()
    // {
    //     return $this->reviews()->min("average_rating") ?? 0;
    // }

    // public function getBestRatingAttribute()
    // {
    //     return $this->reviews()->max("average_rating") ?? 0;
    // }
}
