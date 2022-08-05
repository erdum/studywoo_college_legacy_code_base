<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\RoleDataTable;
use Modules\College\Entities\Role;
use Modules\College\Http\Repository\RoleRepository;
use Modules\College\Http\Requests\CreateRoleRequest;

class RoleController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    protected $roleRepository;


    public function __construct(RoleRepository $roleRepository)
    {
        parent::__construct();
        $this->roleRepository=$roleRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('college::role.index');
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateRoleRequest $request)
    {
        return $this->roleRepository->addOrEdit($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Role $id)
    {
        $id->delete();
        return $this->jsonResponse('Role',200,'delete');

    }
}
