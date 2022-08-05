<?php
namespace Modules\College\Http\Repository;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Modules\College\Entities\Affiliated;
use Modules\College\Entities\City;
use Modules\College\Http\Requests\CreateAffiliatedRequest;
use Modules\College\Http\Requests\CreateCityRequest;

class AffiliatedRepository{
    use RepositoryTrait;
    use ControllerTrait;

    public function addOrEdit(CreateAffiliatedRequest $request){
        try {
            
            // check if transaction is success or not.
           return DB::transaction(function () use($request) {
            $data=$request->validated();
                $response= $this->createOrUpdate(new Affiliated() , $data);
                return $this->jsonResponse('Affiliated ',$response['status_code']);

            });



        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }
}
