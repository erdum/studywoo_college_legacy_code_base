<?php

namespace Modules\College\Http\Repository;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use CreateCollegeFaqsTable;
use Illuminate\Support\Facades\DB;
use Modules\College\Entities\CollegeCourse;
use Modules\College\Entities\CollegeFaq;
use Modules\College\Entities\Faq;
use Modules\College\Http\Requests\CreateCollegeCourseRequest;

class CollegeCourseRepository
{
    use RepositoryTrait;
    use ControllerTrait;

    public function addOrEdit(CreateCollegeCourseRequest $request)
    {
        try {
          // dd($request->validated());
            // check if transaction is success or not.
            return DB::transaction(function () use ($request) {

                $data = $request->validated();

                $response = $this->createOrUpdate(new CollegeCourse(), $data);
                //CollegeRepository::dispatcher($data['college_id']);
                return $this->jsonResponse('College Course', $response['status_code']);
            });
        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }
}
