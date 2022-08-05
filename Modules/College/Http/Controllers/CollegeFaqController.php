<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use CreateCollegeFaqsTable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\CollegeFaqDataTable;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeFaq;
use Modules\College\Entities\Faq;
use Modules\College\Http\Repository\CollegeFaqRepository;
use Modules\College\Http\Requests\CreateCollegeFaqRequest;

class CollegeFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     use ControllerTrait;
     use RepositoryTrait;
    protected $collegeFaqRepository;


    public function __construct(CollegeFaqRepository $collegeFaqRepository)
    {
        parent::__construct();
        $this->collegeFaqRepository = $collegeFaqRepository;
    }

    public function index(College $college, CollegeFaqDataTable $dataTable)
    {
        return $dataTable->with("id", $college->id)->render("college::college.faqList", ['college_id' => $college->id, 'college'=>$college->name]);
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateCollegeFaqRequest $request)
    {
        checkMiddleware('Add FAQ');
        return $this->collegeFaqRepository->addOrEdit($request);
    }




    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function delete( $college_faq)
    {
        checkMiddleware('Delete FAQ');
    //dd($college_faq);
        $collegeFaq=CollegeFaq::where('faq_id', $college_faq)->first();
        $collegeFaq->delete();
        $faq=Faq::where('id',$college_faq)->first();
        $faq->delete();
        return $this->jsonResponse('College FAQ',200,'delete');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function getAddFAQPage($college)
    {
        checkMiddleware('Add FAQ');
        $college= College::where('id', $college)->first();
       return view('college::college.addFAQ')->with('college',$college->id)->with( 'college_name',$college->name);
    }
}
