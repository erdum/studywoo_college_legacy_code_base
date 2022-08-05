<?php
namespace Modules\College\Http\Repository;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Modules\College\Entities\EntranceExam;
use Modules\College\Http\Requests\CreateEntranceExamRequest;

class EntranceExamRepository{
    use RepositoryTrait;
    use ControllerTrait;

    public function addOrEdit(CreateEntranceExamRequest $request){
        try {
            
            // check if transaction is success or not.
           return DB::transaction(function () use($request) {
            $data=$request->validated();
                $response= $this->createOrUpdate(new EntranceExam() , $data);
                return $this->jsonResponse('Entrance Exam',$response['status_code']);

            });



        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }
}
