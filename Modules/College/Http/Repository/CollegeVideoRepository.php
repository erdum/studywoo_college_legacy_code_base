<?php

namespace Modules\College\Http\Repository;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use CreateCollegeFaqsTable;
use Illuminate\Support\Facades\DB;
use Modules\College\Entities\CollegeVideo;
use Modules\College\Entities\Video;
use Modules\College\Http\Requests\CreateCollegeVideoRequest;

class CollegeVideoRepository
{
    use RepositoryTrait;
    use ControllerTrait;

    public function addOrEdit(CreateCollegeVideoRequest $request)
    {

        try {

            // check if transaction is success or not.
            return DB::transaction(function () use ($request) {

                $data = $request->validated();
                $video = parse_url($request->url,PHP_URL_QUERY);
                $url=str_replace('v=','',$video);
                $data['url']= $url;
                $response = $this->createOrUpdate(new Video(), $data);

                $data['video_id']= $response['model']->id;

                $this->createOrUpdate(new CollegeVideo(), $data);

                CollegeRepository::dispatcher($data['college_id']);
                return $this->jsonResponse('College Video', $response['status_code']);
            });
        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }
}
