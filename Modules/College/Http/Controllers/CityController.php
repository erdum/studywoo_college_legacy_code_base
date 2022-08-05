<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\CityDataTable;
use Modules\College\Entities\City;
use Modules\College\Entities\State;
use Modules\College\Http\Repository\CityRepository;
use Modules\College\Http\Requests\CreateCityRequest;

class CityController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    protected $cityRepository;


    public function __construct(CityRepository $cityRepository)
    {
        parent::__construct();
        $this->cityRepository=$cityRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(CityDataTable $dataTable)
    {
        return $dataTable->render('college::city.index',['states'=> State::get()]);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateCityRequest $request)
    {
        return $this->cityRepository->addOrEdit($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(City $id)
    {
        $id->delete();
        return $this->jsonResponse('City',200,'delete');

    }


}
