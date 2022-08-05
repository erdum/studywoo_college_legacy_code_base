<?php

namespace Modules\College\Http\Repository;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Modules\College\Entities\CollegeSubpage;
use Modules\College\Http\Requests\CreateSubPageRequest;

class CollegeSubPageRepository
{
    use RepositoryTrait;
    use ControllerTrait;

    public function addOrEdit(CreateSubPageRequest $request)
    {
     //   dd($request->validated());
        try {
            // check if transaction is success or not.
            return DB::transaction(function () use ($request) {
                $data = $request->validated();
                $data['created_by'] = auth()->user()->id;
                $response = $this->createOrUpdate(new CollegeSubpage(), $data);
               // CollegeRepository::dispatcher($data['college_id']);
                return $this->jsonResponse('College Subpage', $response['status_code']);
            });
        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }
}
