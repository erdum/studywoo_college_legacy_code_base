<?php

namespace Modules\College\Http\Controllers;

use App\Models\User;
use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\AdminDetail;
use Modules\College\DataTables\UserDataTable;
use Modules\College\Entities\Role;
use Modules\College\Http\Repository\UserRepository;
use Intervention\Image\ImageManagerStatic as Image;
use Modules\Admin\Entities\Admin;
use Modules\College\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    protected $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository=$userRepository;
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(UserDataTable $dataTable)
    {
        checkMiddleware('Manage User');
        $userTable = DB::table('admins')->get();
        return $dataTable->render('college::user.index',[
            'user_table' => $userTable,
            ]);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateUserRequest $request)
    {
        dd($request);
        checkMiddleware('Manage User');
        return $this->userRepository->addOrEdit($request);
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Admin $id)
    {
        checkMiddleware('Manage User');
        $id->delete();
        return $this->jsonResponse('User',200,'delete');

    }

    public function viewProfile(){
        return view("college::user.profile",['user'=>auth()->user()->adminDetail]);
    }
    
    public function update_user_status(Request $request){
        $status = $request->status;
        $token = $request->_token;
        $status_user = $request->status_user;
        foreach($status_user as $user){
            DB::table('admins')->where('id','=',$user)->update(['status' => $status]);
        }
        return response()->json($status);
    }

    public function change_user_password(Request $request){
        $password = bcrypt($request->password);
        $token = $request->_token;
        $password_user = $request->password_user;
        foreach($password_user as $user){
            DB::table('admins')->where('id','=',$user)->update(['password' => $password]);
        }
        return response()->json($password);
    }

    public function saveProfile(Request $request){
       //dd($request->all());
       $thumb_path =   'images/admin/avatar/thumb';
       if (!file_exists('images/admin/avatar')) {
           mkdir('images/admin/avatar', 0777, true);
       }

       if (!file_exists($thumb_path)) {
           mkdir($thumb_path, 0777, true);
       }

       // image filename
       $filename = time() . "." . $request->file('avatar')->getClientOriginalExtension();
       $img = Image::make($request->file('avatar'));

       // saving original image
       $img->save('images/admin/avatar' . '/' . $filename);

       // resize the image so that the largest side fits within the limit; the smaller
       // side will be scaled to maintain the original aspect ratio
       $img->resize(96, 96, function ($constraint) {
           $constraint->aspectRatio();
           $constraint->upsize();
       });

       //      saving thumbnail image
       $img->save($thumb_path . '/' . $filename);

       $path='images/admin/avatar/thumb'.'/'. $filename;

        $user=AdminDetail::where('admin_id',auth()->user()->adminDetail->admin_id)->first();
        //dd($user);
        $user->details=$request->details;
        $user->first_name=$request->firstname;
        $user->last_name=$request->lastname;
        $user->address=$request->address;
        $user->emailAddress=$request->emailAddress;
        $user->phone=$request->phone;
        $user->date_of_birth=$request->date_of_birth;
        $user->gender=$request->gender;
        $user->facebook=$request->facebook;
        $user->instagram=$request->instagram;
        $user->twitter=$request->twitter;
        $user->linkedin=$request->linkedin;
        $user->github=$request->github;
        $user->skype=$request->skype;
        $user->avatar=$path;
        $user->save();
        return $this->jsonResponse('UserDetail',201);
    }
}
