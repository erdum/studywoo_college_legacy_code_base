<?php
namespace Modules\College\Http\Repository;


use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Modules\College\Entities\User;
use Modules\College\Entities\UserRole;
use Modules\College\Http\Requests\CreateUserRequest;

class UserRepository{
    use RepositoryTrait;
    use ControllerTrait;

    public function addOrEdit(CreateUserRequest $request){
        try {
           
            // check if transaction is success or not.
           return DB::transaction(function () use($request) {
            $data=$request->validated();
            $data['password']=bcrypt($data['password']);
            $data['permissions']=json_encode($data['permissions']);
            //dd($data);
                $response= $this->createOrUpdate(new User() , $data);
               // $this->addRoles($request->roles,$response['model']->id);
                return $this->jsonResponse('User',$response['status_code']);

            });



        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }

    // public function addRoles(array $roles, int $userid){

    //     foreach($roles as $role){
    //         UserRole::create([
    //             'user_id'=>$userid,
    //             'role_id'=>$role
    //         ]);
    //     }
    //     return;
    // }
}
