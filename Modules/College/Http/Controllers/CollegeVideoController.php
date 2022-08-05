<?php

namespace Modules\College\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\DataTables\CollegeVideoDataTable;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeVideo;
use Modules\College\Entities\Video;
use Modules\College\Http\Repository\CollegeVideoRepository;
use Modules\College\Http\Requests\CreateCollegeVideoRequest;

class CollegeVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use RepositoryTrait;
    use ControllerTrait;

    protected $collegeVideoRepository;


    public function __construct(CollegeVideoRepository $collegeVideoRepository)
    {
        parent::__construct();
        $this->collegeVideoRepository = $collegeVideoRepository;
    }


    public function index(College $college, CollegeVideoDataTable $dataTable)
    {
        return $dataTable->with("id", $college->id)->render("college::college.videoList", [
            'college_id' => $college->id,
            'college'=>$college->name
        ]);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateCollegeVideoRequest $request)
    {
        checkMiddleware('Add Video');
        return $this->collegeVideoRepository->addOrEdit($request);
    }

    public function delete($college_video)
    {
        checkMiddleware('Delete Video');
        $collegeVideo=CollegeVideo::where('id',$college_video)->first();
        $video=Video::where('id', $collegeVideo->video_id);
        $collegeVideo->delete();
        $video->delete();
        return $this->jsonResponse('College Video',200,'delete');
    }
}
