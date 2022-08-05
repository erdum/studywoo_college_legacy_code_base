<?php
namespace Modules\College\Http\Repository;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Modules\College\Entities\CollegeType;
use Modules\College\Http\Requests\CreateCollegeTypeRequest;

class CollegeTypeRepository{
    use RepositoryTrait;
    use ControllerTrait;

    public function addOrEdit(CreateCollegeTypeRequest $request){
        try {

            // check if transaction is success or not.
           return DB::transaction(function () use($request) {
            $data=$request->validated();
                $response= $this->createOrUpdate(new CollegeType() , $data);
                return $this->jsonResponse('College type',$response['status_code']);

            });



        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }
}
