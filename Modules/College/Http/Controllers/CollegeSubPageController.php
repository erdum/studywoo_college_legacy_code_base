<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\College\DataTables\CollegeCourseDataTable;
use Modules\College\DataTables\CollegeSubPageDataTable;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeSubpage;
use Modules\College\Http\Repository\CollegeSubPageRepository;
use Modules\College\Http\Requests\CreateSubPageRequest;

class CollegeSubPageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    use ControllerTrait;
    use RepositoryTrait;

    protected $subPageRepository;


    public function __construct(CollegeSubPageRepository $subPageRepository)
    {
        parent::__construct();
        $this->subPageRepository = $subPageRepository;
    }


    public function index(College $college, CollegeSubPageDataTable $dataTable)
    {
        return $dataTable->with("id", $college->id)->render("college::college.subPageList", ['college_id' => $college->id,'college'=>$college->name]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(College $college)
    {
        checkMiddleware('Add Subpage');
        return view('college::college.addSubPage', ['college_id' => $college->id, 'college'=>$college->name]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateSubPageRequest $request)
    {
        checkMiddleware('Add Subpage');
        // dd($request->all());
        return $this->subPageRepository->addOrEdit($request);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function deleteSubpage($subpage)
    {
        checkMiddleware('Delete Subpage');
        $subPage=CollegeSubpage::where('id',$subpage)->first();
        $subPage->delete();
        return $this->jsonResponse('College Subpage',200, 'delete');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateSubpage(Request $request, $college, $subpage)
    {
        checkMiddleware('Edit Subpage');
        $subPage=CollegeSubpage::where('id',$subpage)->first();
        $data=$request->all();
        $subPage->title=$data['title'];
        $subPage->slug=$data['slug'];
        $subPage->content=$data['content'];
        $subPage->save();
        DB::table('college_subpages')->where('id','=',$data['id'])->update(['last_updated_by'=>$request->admin_id]);
        return $this->jsonResponse('College Subpage',200);
        //return redirect()->route('admin.college.subpage.list',['college'=>$college]);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function editSubpage($subpage){
        $admin_id = Auth::user()->id;
        checkMiddleware('Edit Subpage');
        return view('college::college.editSubPage',['admin_id'=>$admin_id])->with('subpage',CollegeSubpage::where('id',$subpage)->first());
    }



    public function addSeo(Request $request, $subpage)
    {
        dd($subpage);
    }
}
