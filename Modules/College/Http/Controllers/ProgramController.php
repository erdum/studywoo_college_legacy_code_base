<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\ProgramDataTable;
use Modules\College\Entities\Program;
use Modules\College\Http\Repository\ProgramRepository;
use Modules\College\Http\Requests\CreateProgramRequest;

class ProgramController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    protected $programRepository;


    public function __construct(ProgramRepository $programRepository)
    {
        parent::__construct();
        $this->programRepository=$programRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ProgramDataTable $dataTable)
    {
        return $dataTable->render('college::program.index');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateProgramRequest $request)
    {
        return $this->programRepository->addOrEdit($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Program $id)
    {
        $id->delete();
        return $this->jsonResponse('Program',200,'delete');

    }
}
