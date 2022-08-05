<?php
namespace Modules\College\Http\Repository;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Modules\College\Entities\CourseType;
use Modules\College\Http\Requests\CreateCourseTypeRequest;

class CourseTypeRepository{
    use RepositoryTrait;
    use ControllerTrait;

    public function addOrEdit(CreateCourseTypeRequest $request){
        try {

            // check if transaction is success or not.
           return DB::transaction(function () use($request) {
            $data=$request->validated();
                $response= $this->createOrUpdate(new CourseType() , $data);
                return $this->jsonResponse('Course type',$response['status_code']);

            });



        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }
}
