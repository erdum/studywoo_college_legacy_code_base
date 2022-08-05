<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Admins Model
use App\Models\Admins;

use App\Http\Controllers\CollegeController;

class UsersProfileController extends Controller
{
    public function index()
    {
        $rows = Admins::all();
        
        foreach ($rows as $index => $row)
        {
            if ($row->author_data) {
                $data = json_decode($row->author_data, true);
                foreach ($data as $key => $value)
                {
                    $row[$key] = $value;
                }
            }
        }
        
        return response()->json($rows);
    }
    
    public static function check_and_save($value, $row, $name)
    {
        if ($value) {
            if ($row->author_data) {
                $data = json_decode($row->author_data, false);
                $data->{$name} = $value;
                $row->author_data = $data;
            } else {
                $row->author_data = (object) [$name => $value];
            }
            $row->author_data = json_encode($row->author_data);
        }
    }
    
    public function update(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach ($rowsToBeEffected as $row)
        {
            $admin = Admins::find($row);
            
            if (!$admin) {
                return response()->json(['message' => 'document does not exist'], 404);
            }
            
            CollegeController::check_and_save($request->name, $admin, 'name');
            CollegeController::check_and_save($request->password, $admin, 'password');
            
            self::check_and_save($request->gender, $admin, 'gender');
            self::check_and_save($request->date_of_birth, $admin, 'date_of_birth');
            self::check_and_save($request->about, $admin, 'about');
            self::check_and_save($request->facebook, $admin, 'facebook');
            self::check_and_save($request->instagram, $admin, 'instagram');
            self::check_and_save($request->twitter, $admin, 'twitter');
            self::check_and_save($request->linkedin, $admin, 'linkedin');
            self::check_and_save($request->youtube, $admin, 'youtube');
            
            if ($request->avatar) {
                $admin->avatar = $request->avatar[0];
            }
            
            $admin->save();
            
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function save_basic_data(Request $request)
    {
        $user = Admins::find($request->user()->id);
        if (!$user) return redirect('/login');
        
        CollegeController::check_and_save($request->name, $user, 'name');
        CollegeController::check_and_save($request->email, $user, 'email');
        CollegeController::check_and_save($request->password, $user, 'password');
        
        self::check_and_save($request->phone, $user, 'phone');
        self::check_and_save($request->gender, $user, 'gender');
        self::check_and_save($request->date_of_birth, $user, 'date_of_birth');
        self::check_and_save($request->city, $user, 'city');
        self::check_and_save($request->state, $user, 'state');
        self::check_and_save($request->address, $user, 'address');
        self::check_and_save($request->detail, $user, 'about');
        
        $user->save();
        
        return redirect('/profile?step=2');
    }
    
    public function save_educational_data(Request $request)
    {
        $user = Admins::find($request->user()->id);
        if (!$user) return redirect('/login');
        
        foreach ($request->all() as $parameter => $value)
        {
            if ($parameter != '_token') self::check_and_save($value, $user, $parameter);
        }
        
        $user->save();
        
        return redirect('/profile');
    }
    
    public function owner_profile(Request $request)
    {
        $owner_profile = Admins::find($request->user()->id);

        if ($owner_profile->author_data) {
            $data = json_decode($owner_profile->author_data, true);
            foreach ($data as $key => $value)
            {
                $owner_profile[$key] = $value;
            }
        }
        
        return response()->json([$owner_profile]);
    }
    
    public function update_owner_profile(Request $request)
    {
        $admin = Admins::find($request->user()->id);
            
        if (!$admin) {
            return response()->json(['message' => 'document does not exist'], 404);
        }
        
        CollegeController::check_and_save($request->name, $admin, 'name');
        CollegeController::check_and_save($request->password, $admin, 'password');
        
        self::check_and_save($request->gender, $admin, 'gender');
        self::check_and_save($request->date_of_birth, $admin, 'date_of_birth');
        self::check_and_save($request->about, $admin, 'about');
        self::check_and_save($request->facebook, $admin, 'facebook');
        self::check_and_save($request->instagram, $admin, 'instagram');
        self::check_and_save($request->twitter, $admin, 'twitter');
        self::check_and_save($request->linkedin, $admin, 'linkedin');
        self::check_and_save($request->youtube, $admin, 'youtube');
        
        if ($request->avatar) {
            $admin->avatar = $request->avatar[0];
        }
        
        $admin->save();
    }
}
