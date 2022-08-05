<?php

namespace Modules\College\Http\Controllers;

use App\Helpers\Cache;
use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\College\DataTables\CollegeDataTable;
use Modules\College\DataTables\CollegeImageDataTable;
use Modules\College\Entities\Affiliated;
use Modules\College\Entities\City;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeAffiliated;
use Modules\College\Entities\CollegeCollegeType;
use Modules\College\Entities\CollegeContact;
use Modules\College\Entities\CollegeCourse;
use Modules\College\Entities\CollegeCourseType;
use Modules\College\Entities\CollegeDetails;
use Modules\College\Entities\CollegeEntranceExam;
use Modules\College\Entities\CollegeFaq;
use Modules\College\Entities\CollegeImage;
use Modules\College\Entities\CollegeProgramType;
use Modules\College\Entities\CollegeStream;
use Modules\College\Entities\CollegeSubpage;
use Modules\College\Entities\CollegeType;
use Modules\College\Entities\CollegeVideo;
use Modules\College\Entities\Course;
use Modules\College\Entities\CourseType;
use Modules\College\Entities\EntranceExam;
use Modules\College\Entities\Image;
use Modules\College\Entities\Program;
use Modules\College\Entities\State;
use Modules\College\Entities\Stream;
use Modules\College\Http\Repository\CollegeRepository;
use Modules\College\Http\Requests\CreateCollegeRequest;

class CollegeController extends Controller
{
    use RepositoryTrait;
    use ControllerTrait;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    protected $collegeRepository;


    public function __construct(CollegeRepository $collegeRepository)
    {
        parent::__construct();

        $this->collegeRepository = $collegeRepository;
    }

    public function index(CollegeDataTable $dataTable)
    {
        $selectState = request()->state ?? null;
        return $dataTable->render(
            'college::college.index',
            [
                "states" => State::all(),
                "selectState" => $selectState,
                "types" => CollegeType::get(),
                "streams" => Stream::get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function getAddEditForm()
    {
        checkMiddleware('Add College');

        return view(
            'college::college.add',
            [
                'states' => State::all(),
                'cities' => City::all(),
                'affiliateds' => Affiliated::all(),
                'entranceExams' => EntranceExam::all(),
                'courses' => Course::get(),
                'courseTypes' => CourseType::get(),
                'collegeTypes' => CollegeType::get(),
                'streams' => Stream::get(),
                'programTypes' => Program::get()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function postAddEdit(CreateCollegeRequest $request)
    {
        checkMiddleware('Add College');
        return $this->collegeRepository->addOrEdit($request);
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function getEditForm($id)
    {
       
        checkMiddleware('Edit College');
        //dd(CollegeContact::where('college_id',$id)->get());
        $college = College::where('id', $id)->first();
        $info = CollegeSubpage::where('college_id', $id)->where('slug', 'info')->first();
        
        if ($info && $info->slug == 'info') {
            $info = $info->content;
        } else {
            $info = '';
        }



        return view(
            "college::college.edit",
            [
                'college' => $college,
                'states' => State::all(),
                'cities' => City::all(),
                'affiliateds' => Affiliated::all(),
                'entranceExams' => EntranceExam::all(),
                'courses' => Course::get(),
                'courseTypes' => CourseType::get(),
                'collegeTypes' => CollegeType::get(),
                'streams' => Stream::get(),
                'programTypes' => Program::get(),
                'info' => $info,
                'contacts' => CollegeContact::where('college_id', $id)->get(),
                'selectedCollegeTypes' => CollegeCollegeType::where('college_id', $id)->get(),
                'selectedAffiliateds' => CollegeAffiliated::where('college_id', $id)->get(),
                'selectedStreams' => CollegeStream::where('college_id', $id)->get(),
                'selectedProgramTypes' => CollegeProgramType::where('college_id', $id)->get(),
                'selectedCourseTypes' => CollegeCourseType::where('college_id', $id)->get(),
                'selectedEntranceExams' => CollegeEntranceExam::where('college_id', $id)->get(),
                'selectedCourses' => CollegeCourse::where('college_id', $id)->get()


            ]
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function imageList(College $college, CollegeImageDataTable $dataTable)
    {
        return $dataTable->with("id", $college->id)->render('college::college.imageList', [
            'college_id' => $college->id,
            'college' => $college->name
        ]);
    }

    public function addImage(Request $request)
    {
        checkMiddleware('Add Image');
        return $this->collegeRepository->addImage($request);
    }

    public function postEdit(CreateCollegeRequest $request)
    {
        
        checkMiddleware('Edit College');
        return back();
    }

    public function deleteImage($image)
    {
        checkMiddleware('Delete Image');
        $collegeImage = CollegeImage::where('id', $image)->first();
        $image_id = $collegeImage->image_id;
        $collegeImage->delete();
        $image = Image::where('id', $image_id)->first();
        $image->delete();
        return $this->jsonResponse('Image', 200, 'delete');
    }

    public function delete(College $college)
    {
        checkMiddleware('Delete College');
        $collegeDetail = CollegeDetails::where('college_id', $college->id)->first();
        $collegeCourse = CollegeCourse::where('college_id', $college->id)->first();
        $collegeSubpages = CollegeSubpage::where('college_id', $college->id)->first();
        $collegeAffiliateds = CollegeAffiliated::where('college_id', $college->id)->first();
        $collegeStreams = CollegeStream::where('college_id', $college->id)->first();
        $collegeFaq = CollegeFaq::where('college_id', $college->id)->first();
        $collegeImages = CollegeImage::where('college_id', $college->id)->first();
        $collegeVideos = CollegeVideo::where('college_id', $college->id)->first();



        // $collegeDetail->delete();
        // $collegeCourse->delete();
        // $collegeSubpages->delete();
        // $collegeAffiliateds->delete();
        // $collegeStreams->delete();
        // $collegeFaq->delete();
        // $collegeImages->delete();
        // $collegeVideos->delete();








    }
}
