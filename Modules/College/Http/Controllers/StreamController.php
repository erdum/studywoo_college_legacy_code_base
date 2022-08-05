<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\StreamDataTable;
use Modules\College\Entities\Stream;
use Modules\College\Http\Repository\StreamRepository;
use Modules\College\Http\Requests\CreateStreamRequest;

class StreamController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    protected $streamRepository;


    public function __construct(StreamRepository $streamRepository)
    {
        parent::__construct();
        $this->streamRepository=$streamRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(StreamDataTable $dataTable)
    {
        return $dataTable->render('college::stream.index');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateStreamRequest $request)
    {
        return $this->streamRepository->addOrEdit($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Stream $id)
    {
        $id->delete();
        return $this->jsonResponse('Stream',200,'delete');

    }
}
