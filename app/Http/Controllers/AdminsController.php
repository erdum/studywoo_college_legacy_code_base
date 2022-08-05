<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
// use Auth;

// Admins model
use App\Models\Admins;

use App\Models\AdminsRoles;


class AdminsController extends Controller
{
    public function clear_tokens($user)
    {
        foreach($user->tokens as $token)
        {
            $token->delete();
        }
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors());
        }
        
        if (Admins::where('email', $request->email)->where('password', $request->password)->first()) {
            return response()->json(['message' => 'User already exist'], 403);
        }
        
        if (Admins::where('name', $request->name)->first()) {
            return response()->json(['message' => 'User name already taken'], 403);
        }
        
        $user = Admins::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'roles' => 'User',
            'status' => true,
            'avatar' => null
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->intended('/customer/profile')->cookie('access_token', $token, 1440);
    }
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $user = Admins::where('email', $request->email)->where('password', $request->password)->first();
    
        if ($user) {
            
            $this->clear_tokens($user);
            
            $token = $user->createToken('auth_token')->plainTextToken;
            
            if ($user->roles == 'User') {
                return redirect()->intended('/listing')->cookie('access_token', $token, 1440);
            }
            
            $payload = [
                'name' => $user->name,
                'roles' => $user->roles,
                'avatar' => $user->avatar
            ];
            
            $permissions = json_decode(AdminsRoles::where('roles', $user->roles)->first()?->permissions);
            
            if ($permissions == null) $permissions = ['None'];
            
            return response()->json(['access_token' => $token, 'user_data' => $payload, 'permissions' => $permissions]);
            
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
    
    public function index()
    {
        return response()->json(Admins::get(['id', 'name', 'email', 'password', 'roles', 'status']));
    }
    
    public function list()
    {
        $users = Admins::all(['name', 'id']);
        
        $list = [];
        
        foreach($users as $user)
        {
            array_push($list, [$user->name, $user->id]);
        }
        
        return response()->json($list);
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'roles' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        if (Admins::where('email', $request->email)->where('password', $request->password)->first()) {
            return response()->json(['message' => 'User already exist'], 403);
        }
        
        if (Admins::where('name', $request->name)->first()) {
            return response()->json(['message' => 'User name already taken'], 403);
        }
        
        Admins::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'roles' => $request->roles,
            'status' => $request->status ?? false,
            'avatar' => null
         ]);
         
         return response()->json(['message' => 'success']);
    }
    
    public function update(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            $admin = Admins::find($row);
            
            if (!$admin) {
                return response()->json(['message' => 'document does not exist']);
            }
            
            if ($request->name) {
                $admin->name = $request->name;
            }
            
            if ($request->email) {
                $admin->email = $request->email;
            }
            
            if ($request->password) {
                $admin->password = $request->password;
            }
            
            if ($request->roles) {
                $admin->roles = $request->roles;
            }
            
            $admin->status = false;
            if ($request->status) {
                $admin->status = true;
            }
            
            $admin->save();
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            Admins::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'success'])->withoutCookie('access_token');
    }
    
    public function countUserTokens(Request $request)
    {
        return response()->json($request->user()->tokens->count());
    }
}