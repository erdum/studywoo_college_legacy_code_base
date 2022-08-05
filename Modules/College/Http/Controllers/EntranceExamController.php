<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\EntranceExamDataTable;
use Modules\College\Entities\EntranceExam;
use Modules\College\Http\Repository\EntranceExamRepository;
use Modules\College\Http\Requests\CreateEntranceExamRequest;

class EntranceExamController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    protected $entranceExamRepository;


    public function __construct(EntranceExamRepository $entranceExamRepository)
    {
        parent::__construct();
        $this->entranceExamRepository=$entranceExamRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(EntranceExamDataTable $dataTable)
    {
        return $dataTable->render('college::entranceExam.index');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateEntranceExamRequest $request)
    {
        return $this->entranceExamRepository->addOrEdit($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(EntranceExam $id)
    {
        $id->delete();
        return $this->jsonResponse('Entrance Exam',200,'delete');

    }
}
