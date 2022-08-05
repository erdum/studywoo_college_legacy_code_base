<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\CollegeCourseDataTable;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeCourse;
use Modules\College\Entities\Course;
use Modules\College\Entities\CourseType;
use Modules\College\Entities\EntranceExam;
use Modules\College\Http\Repository\CollegeCourseRepository;
use Modules\College\Http\Requests\CreateCollegeCourseRequest;

class CollegeCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use RepositoryTrait;
    use ControllerTrait;

    protected $collegeCourseRepository;


    public function __construct(CollegeCourseRepository $collegeCourseRepository)
    {
        parent::__construct();
        $this->collegeCourseRepository = $collegeCourseRepository;
    }


    public function index(College $college, CollegeCourseDataTable $dataTable)
    {

        return $dataTable->with("id", $college->id)->render('college::college.courseLIst', [
            'college_id' => $college->id,
            'college' => $college->name,
            'entranceExams' => EntranceExam::all(),
            'courses' => Course::get(),
            'courseTypes' => CourseType::get(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateCollegeCourseRequest $request)
    {
        checkMiddleware('Add Course');
        return $this->collegeCourseRepository->addOrEdit($request);
    }

    public function delete($college_course)
    {
        checkMiddleware('Delete Course');
        $collegeCourse = CollegeCourse::where('id', $college_course)->first();
        $collegeCourse->delete();
        return $this->jsonResponse('Course', 200, 'delete');
    }
}
