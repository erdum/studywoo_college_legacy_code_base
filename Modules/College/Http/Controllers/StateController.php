<?php

namespace Modules\College\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Modules\College\DataTables\StateDataTable;
use Modules\College\Entities\State;
use Modules\College\Http\Repository\StateRepository;
use Modules\College\Http\Requests\CreateStateRequest;

class StateController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    protected $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        parent::__construct();
        $this->stateRepository=$stateRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(StateDataTable $dataTable)
    {
        return $dataTable->render('college::state.index');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateStateRequest $request)
    {
        return $this->stateRepository->addOrEdit($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(State $id)
    {
        $id->delete();
        return $this->jsonResponse('State',200,'delete');

    }

    public function changeStatus(State $state){

        $state->active_status = $state->active_status ? 0 : 1;
        $state->save();
        return back()->with('message','State status changed successfully');
    }
}
