<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\CourseTypeDataTable;
use Modules\College\Entities\CourseType;
use Modules\College\Http\Repository\CourseTypeRepository;
use Modules\College\Http\Requests\CreateCourseTypeRequest;

class CourseTypeController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    protected $courseTypeRepository;


    public function __construct(CourseTypeRepository $courseTypeRepository)
    {
        parent::__construct();
        $this->courseTypeRepository=$courseTypeRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CourseTypeDataTable $dataTable)
    {
        return $dataTable->render('college::courseType.index');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateCourseTypeRequest $request)
    {
        return $this->courseTypeRepository->addOrEdit($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(CourseType $id)
    {
        $id->delete();
        return $this->jsonResponse('Course type',200,'delete');

    }
}
