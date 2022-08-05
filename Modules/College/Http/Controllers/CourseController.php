<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\CourseDataTable;
use Modules\College\Entities\Course;
use Modules\College\Http\Repository\CourseRepository;
use Modules\College\Http\Requests\CreateCourseRequest;

class CourseController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    protected $courseRepository;


    public function __construct(CourseRepository $courseRepository)
    {
        parent::__construct();
        $this->courseRepository=$courseRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CourseDataTable $dataTable)
    {
        return $dataTable->render('college::course.index');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateCourseRequest $request)
    {
        return $this->courseRepository->addOrEdit($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Course $id)
    {
        $id->delete();
        return $this->jsonResponse('Course',200,'delete');

    }
}
