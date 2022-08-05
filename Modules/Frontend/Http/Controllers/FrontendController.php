<?php

namespace Modules\Frontend\Http\Controllers;

use App\Helpers\Cache;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Log\Logger;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache as FacadesCache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\Cache as EntitiesCache;
use Modules\College\Entities\Affiliated;
use Modules\College\Entities\City;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeAffiliated;
use Modules\College\Entities\CollegeCourse;
use Modules\College\Entities\CollegeDetails;
use Modules\College\Entities\CollegeFaq;
use Modules\College\Entities\CollegeStream;
use Modules\College\Entities\CollegeType;
use Modules\College\Entities\Course;
use Modules\College\Entities\CourseType;
use Modules\College\Entities\EntranceExam;
use Modules\College\Entities\Review;
use Modules\College\Entities\State;
use Modules\College\Entities\Stream;
use Modules\College\Transformers\CollegeListItem;
use Modules\College\Transformers\CollegeResource;
use Modules\Customer\Entities\CustomerComment;
use Modules\Customer\Entities\CustomerReview;
use SystemConfig;
use TOC\TocGenerator;
use TOC\MarkupFixer;

// Main Models
use App\Models\Reviews;
use App\Models\Comments;
use App\Models\Faq;
use App\Models\Admins;
use App\Models\Pages;
use App\Models\Author;
use App\Models\SiteSetting;

class FrontendController extends Controller
{

    private $cities;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // $popularCollege = College::select("id", "name", "slug", "city_id", "state_id")->latest()->limit(6)->get();

        return view('pages.home.index');
    }
    
    public function getDetailPage(Request $request, $slug, $page = '')
    {
        if ($page == 'info') abort(404);
        
        if ($page == '') $page = 'info';
        
        $college = College::where("slug", $slug)->first();
        
        if (!$college) abort(404);
        
        $page_id;
        $page_seo = Pages::where('page_id', $college->slug)->first() ?? null;
        
        if ($page_seo) {
            $page_id = $page_seo->slug;
            $meta_title = $page_seo->title;
            $meta_description = $page_seo->meta_description;
        }
        
        $subpage = $college->subPages->where('slug', $page)->first();
        
        if (!$subpage) abort(404);
        
        $college->info_page = $subpage->content;
        $college->created_at = $subpage->created_at;
        $college->updated_at = $subpage->updated_at;
        
        $markupFixer  = new MarkupFixer();
        $tocGenerator = new TocGenerator();
        
        $college->info_page = $markupFixer->fix($college->info_page ?? '');
        $college->tocMenu = $tocGenerator->getHtmlMenu($college->info_page);
        
        return view(
            "pages.detail.detail",
            [
                'title' => $subpage->title ?? '',
                'meta_title' => $meta_title ?? $subpage->meta_title ?? '',
                'meta_description' => $meta_description ?? $subpage->meta_description ?? '',
                
                'college' => $college,
                'college_image' => $college->featuredImages ? 'photos/' . json_decode($college->featuredImages)[0] . '.webp' : null,
                'active_page' => $page,

                'page_id' => $page_id ?? $college->slug,
                'user_id' => $request->user()->id ?? '',
                'comment_submit_url' => '/api/comment',
                'review_submit_url' => '/api/review',
                
                'author' => $subpage->author,
                'user' => $request->user(),
                
                'widget_html' => SiteSetting::where('name', 'custom_html')->first()->settings ?? null
            ]
        );
    }

    // public function returnSubpages($college, $page)
    // {

    //     $comments = CustomerComment::where('college_id', $college->id)->orderBy('id', 'desc')->get();
    //     $faqs = CollegeFaq::where('college_id', $college->id)->get();
    //     $courses = CollegeCourse::where('college_id', $college->id)->get();

    //     if (!$page)
    //         $page = "info";
    //     switch ($page) {
    //         case 'info':
    //             return view('frontend::pages.detail.subpages.info', ['subpage' => $college->subPage($page)]);
    //             break;
    //         case 'review':
    //             return view(
    //                 'frontend::pages.detail.subpages.review',
    //                 [
    //                     'reviews' => $college->reviews,
    //                     'college' => $college
    //                 ]
    //             );
    //             break;

    //         case 'comments':
    //             return view(
    //                 'frontend::pages.detail.subpages.comment',
    //                 [
    //                     'comments' => $comments,
    //                     'college' => $college
    //                 ]
    //             );
    //             break;

    //         case 'faq':
    //             return view(
    //                 'frontend::pages.detail.subpages.faq',
    //                 [
    //                     'faqs' => $faqs,
    //                     'college' => $college
    //                 ]
    //             );
    //             break;

    //         case 'course':

    //             return view(
    //                 'frontend::pages.detail.subpages.course',
    //                 [
    //                     'courses' => $courses
    //                 ]
    //             );
    //             break;
    //         default:
    //             return view('frontend::pages.detail.subpages.info', ['subpage' => $college->subPage($page)]);
    //             break;
    //     }
    // }


    public function  register()
    {
        return view("frontend::pages.register.index");
    }

    public function  login()
    {
        return view("pages.login.index");
    }

    public function getOtp(Request $request)
    {
        if (!auth()->guard("customer")->check())
            return redirect()->route("login")->with("error", "Please Login First");

        $lastOtp = auth()->guard('customer')->user()->otp->last();
        if ($lastOtp) {
            $start  = new Carbon($lastOtp->created_at);
            $end    = Carbon::now();
            if ($end->diffInRealMinutes($start) < 2) {
                $request->session()->flash("error", "Please try after 2 minutes");
                return view("frontend::pages.otp.index");
            }
        }
        $code = random_int(100000, 999999);

        dispatch(function () use ($code) {
            Mail::send('customer::otp.index', ['otp' => $code], function ($message) {
                $message->to(auth()->guard('customer')->user()->email, auth()->guard('customer')->user()->customerDetail->full_name)
                    ->subject("OTP Verification");
                $message->from(env('MAIL_FROM_ADDRESS'), SystemConfig::get('app-name'));
            });
        })->afterResponse();


        auth()->guard('customer')->user()->otp()->create(['code' => bcrypt($code)]);

        $request->session()->flash('success', 'Please check email to verify account.');
        return view("frontend::pages.otp.index");
    }


    public function getAuthor($author, Request $request)
    {
        $id = explode("-", $author);
        $id = end($id);
        
        $author = Admins::where('id', $id)->first();
        
        $page = $request->page ?? 1;
        $subpages = $author->subpages()->offset(($page - 1) * 10)->limit(10)->get();
        $totalCount = $author->subpages()->get()->count();
        $maxPage = (int) floor($totalCount / 10);
        
        if ($page > $maxPage) abort(404);
        
        return view(
            'pages.author.index',
            [
                'author' => $author,
                'subpages' => $subpages,
                'maxPage' => $maxPage,
                'pageCount' => $page - 1
            ]
        );
    }

    public function filterList(Request $request)
    {
        // return(College::filterList($request));
        return view('frontend::pages.listing.filter', ['collegeListing' => College::filterList($request)]);
    }

    public function singleReview(CustomerReview $review)
    {
        return view("frontend::pages.review.single", ['review' => $review]);
    }



    public function filterCollege(Request $request, $filter1 = null, $filter2 = null, $filter3 = null)
    {
        $collegeListing = College::select("id", "name", "slug", "city_id", "state_id")->latest();

        // if ($request->search) {
        //     $collegeListing = $collegeListing

        //         ->whereHas("subPages", function ($q) use ($request) {
        //             $q->where("title", "like", "%$request->search%")
        //                 ->orWhere("content", "like", "%$request->search%");
        //         })
        //         ->orWhere("name", "like", "%$request->search%");
        // }
        
        // $search_data = $request->search;
        // $search_result = DB::table('search_table')->where('search','LIKE',"%$search_data%")->increment('htis');
        // if($search_result == null){
        //     $date_now = date('Y-m-d H:i:s');
        //     DB::table('search_table')->insert(['search'=>$search_data,'htis'=>1,'updated_at'=>$date_now]);
        // }

        // $condition = null;
        // if ($filter1) {
        //     $condition = $this->findFilterID($filter1);
        //     if ($condition) {
        //         if ($condition[2]) {
        //             $id = Course::where("slug", $filter1)->first()->id ?? null;
        //             $collegeListing->whereHas("courses", function ($q) use ($id) {
        //                 $q->where("course_id", $id);
        //             });
        //         } else
        //             $collegeListing->where($condition[0], $condition[1]);
        //         $condition = null;
        //     }
        // }

        // if ($filter2) {
        //     $condition = $this->findFilterID($filter2);
        //     if ($condition) {
        //         if ($condition[2]) {
        //             $id = Course::where("slug", $filter2)->first()->id ?? null;
        //             $collegeListing->whereHas("courses", function ($q) use ($id) {
        //                 $q->where("course_id", $id);
        //             });
        //         } else
        //             $collegeListing->where($condition[0], $condition[1]);
        //         $condition = null;
        //     }
        // }

        // if ($filter3) {
        //     $condition = $this->findFilterID($filter3);
        //     if ($condition) {
        //         if ($condition[2]) {
        //             $id = Course::where("slug", $filter3)->first()->id ?? null;
        //             $collegeListing->whereHas("courses", function ($q) use ($id) {
        //                 $q->where("course_id", $id);
        //             });
        //         } else
        //             $collegeListing->where($condition[0], $condition[1]);
        //         $condition = null;
        //     }
        // }


        // if ($request->college_affilate) {

        //     $id = Affiliated::where("slug", $request->college_affilate)->first()->id ?? null;

        //     $collegeListing->whereHas("affiliated", function ($q) use ($id) {
        //         $q->where("affiliated_id", $id);
        //     });
        // }

        // // // parameter filter

        // if ($request->college_type) {
        //     $id = CollegeType::where("slug", $request->college_type)->first()->id ?? null;

        //     $collegeListing->whereHas("collegeType", function ($q) use ($id) {
        //         $q->where("college_type_id", $id);
        //     });
        // }

        // if ($request->stream) {
        //     $id = Stream::where("slug", $request->stream)->first()->id ?? null;
        //     $collegeListing->whereHas("stream", function ($q) use ($id) {
        //         $q->where("stream_id", $id);
        //     });
        // }
        // if ($request->course_type) {
        //     $id = CourseType::where("slug", $request->course_type)->first()->id ?? null;
        //     $collegeListing->whereHas("courseType", function ($q) use ($id) {
        //         $q->where("course_type_id", $id);
        //     });
        // }

        // if ($request->entrance) {
        //     $id = EntranceExam::where("slug", $request->entrance)->first()->id ?? null;

        //     $collegeListing->whereHas("entrance", function ($q) use ($id) {
        //         $q->where("entrance_exam_id", $id);
        //     });
        // }

        return view(
            "frontend::pages.listing.listing",
            [
            ]
        );
    }
    public function search_trend(){
        $search_trend = DB::table('search_table')->select()->orderBy('htis','desc')->limit(7)->get();
        return response()->json($search_trend);
    }
    public function search_list(Request $request)
    {
        $search = '%' . $request->search . '%';
        $database = DB::table('colleges')
            ->orderBy('id', 'desc')
            ->join('cities', 'cities.id', '=', 'colleges.city_id')
            ->join('states', 'states.id', '=', 'colleges.state_id')
            ->join('college_courses', 'college_courses.college_id', '=', 'colleges.id')
            ->join('courses', 'courses.id', '=', 'college_courses.course_id')
            ->join('college_affiliateds', 'college_affiliateds.college_id', '=', 'colleges.id')
            ->join('affiliateds', 'affiliateds.id', '=', 'college_affiliateds.affiliated_id')
            ->join('college_college_types', 'college_college_types.college_id', '=', 'colleges.id')
            ->join('college_types', 'college_types.id', '=', 'college_college_types.college_type_id')
            ->join('college_streams', 'college_streams.college_id', '=', 'colleges.id')
            ->join('streams', 'streams.id', '=', 'college_streams.stream_id')
            ->join('college_entrance_exams', 'college_entrance_exams.college_id', '=', 'colleges.id')
            ->join('entrance_exams', 'entrance_exams.id', '=', 'college_entrance_exams.entrance_exam_id')
            ->join('college_course_types', 'college_course_types.college_id', '=', 'colleges.id')
            ->join('course_types', 'course_types.id', '=', 'college_course_types.course_type_id')
            ->select('colleges.id', 'colleges.name', 'colleges.slug', 'college_types.name AS type')
            ->where('colleges.name', 'LIKE', "%{$search}%")
            ->orWhere('colleges.slug', 'LIKE', "%{$search}%")
            ->orWhere('cities.name', 'LIKE', "%{$search}%")
            ->orWhere('states.name', 'LIKE', "%{$search}%")
            ->orWhere('courses.name', 'LIKE', "%{$search}%")
            ->orWhere('courses.slug', 'LIKE', "%{$search}%")
            ->orWhere('affiliateds.name', 'LIKE', "%{$search}%")
            ->orWhere('affiliateds.slug', 'LIKE', "%{$search}%")
            ->orWhere('college_types.name', 'LIKE', "%{$search}%")
            ->orWhere('college_types.slug', 'LIKE', "%{$search}%")
            ->orWhere('streams.name', 'LIKE', "%{$search}%")
            ->orWhere('streams.slug', 'LIKE', "%{$search}%")
            ->orWhere('entrance_exams.name', 'LIKE', "%{$search}%")
            ->orWhere('entrance_exams.slug', 'LIKE', "%{$search}%")
            ->orWhere('course_types.name', 'LIKE', "%{$search}%")
            ->orWhere('course_types.slug', 'LIKE', "%{$search}%")
            ->distinct('college_types.name')
            ->get(['colleges.*']);
        $result_count = count($database);
        // $result_name = $database[0]->name;
        $img_link = array();
        for ($i = 0; $i < $result_count; $i++) {
            $college = College::where("slug", $database[$i]->slug)->first();
            if ($college->collegeLogo) {
                $img_link_url = asset($college->collegeLogo->imageUrl);
                array_push($img_link, ["id" => $database[$i]->id, "name" => $database[$i]->name, "type" => $database[$i]->type, "img_url" => $img_link_url]);
            } else {
                $img_link_url = 'https://ui-avatars.com/api/?name=' . substr($college->name, 0, 2);
                array_push($img_link, ["id" => $database[$i]->id, "name" => $database[$i]->name, "type" => $database[$i]->type, "img_url" => $img_link_url]);
            }
            /* if (File::exists(url('/logo/'.$database[$i]->name.' logo.png'))) {
                $img_link_url = '/logo/'.$database[$i]->name.'.png';
                array_push($img_link,["id"=>$database[$i]->id,"name"=>$database[$i]->name,"type"=>$database[$i]->type,"img_url"=>$img_link_url]);
              }else{
                $img_link_url = '';
                array_push($img_link,["id"=>$database[$i]->id,"name"=>$database[$i]->name,"type"=>$database[$i]->type,"img_url"=>$img_link_url]);
              } */
        }
        return response()->json($img_link);
    }


    protected function findFilterID($slug)
    {
        $value = State::where('slug', $slug)->first();
        if ($value && isset($value->id) && $value->id) {
            $this->cities = City::where("state_id", $value->id)->get();
            return ['state_id', $value->id, false];
        }
        $value = City::where('slug', $slug)->first();
        if ($value && isset($value->id) && $value->id) {
            return ['city_id', $value->id, false];
        }
        $value = Course::where('slug', $slug)->first();
        if ($value && isset($value->id) && $value->id) {
            return ['course_id', $value->id, true];
        }
    }
}
