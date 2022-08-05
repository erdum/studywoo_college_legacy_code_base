<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\AffiliatedDataTable;
use Modules\College\Entities\Affiliated;
use Modules\College\Http\Repository\AffiliatedRepository;
use Modules\College\Http\Requests\CreateAffiliatedRequest;

class AffiliatedController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    protected $affiliatedRepository;


    public function __construct(AffiliatedRepository $affiliatedRepository)
    {
        parent::__construct();
        $this->affiliatedRepository=$affiliatedRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(AffiliatedDataTable $dataTable)
    {
        return $dataTable->render('college::affiliated.index');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateAffiliatedRequest $request)
    {
        return $this->affiliatedRepository->addOrEdit($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Affiliated $id)
    {
        $id->delete();
        return $this->jsonResponse('Affiliated',200,'delete');

    }
}
