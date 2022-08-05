<?php
namespace Modules\College\Http\Repository;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use CreateStatesTable;
use Illuminate\Support\Facades\DB;
use Modules\College\Entities\State;
use Modules\College\Http\Requests\CreateStateRequest;

class StateRepository{
    use RepositoryTrait;
    use ControllerTrait;

    public function addOrEdit(CreateStateRequest $request){
        try {
            
            // check if transaction is success or not.
           return DB::transaction(function () use($request) {
            $data=$request->validated();
                $response= $this->createOrUpdate(new State() , $data);
                return $this->jsonResponse('State',$response['status_code']);

            });



        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }
}
