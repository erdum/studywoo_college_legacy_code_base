<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\CollegeTypeDataTable;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeType;
use Modules\College\Http\Repository\CollegeTypeRepository;
use Modules\College\Http\Requests\CreateCollegeTypeRequest;

class CollegeTypeController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    protected $collegeTypeRepository;


    public function __construct(CollegeTypeRepository $collegeTypeRepository)
    {
        parent::__construct();
        $this->collegeTypeRepository=$collegeTypeRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CollegeTypeDataTable $dataTable)
    {
        return $dataTable->render('college::collegeType.index');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateCollegeTypeRequest $request)
    {
        return $this->collegeTypeRepository->addOrEdit($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(CollegeType $id)
    {
        $id->delete();
        return $this->jsonResponse('College Type',200,'delete');

    }
}
