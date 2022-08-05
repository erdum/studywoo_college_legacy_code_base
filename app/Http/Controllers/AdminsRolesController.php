<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

// AdminsRoles Model
use App\Models\AdminsRoles;

class AdminsRolesController extends Controller
{
    public function index()
    {
        $rows = AdminsRoles::all();
        
        foreach ($rows as $row)
        {
            $row->permissions = json_decode($row->permissions);
        }
        
        return response()->json($rows);
    }
    
    public function list()
    {
        $list = [];
        $rows = AdminsRoles::all(['id', 'roles']);
        
        foreach($rows as $row)
        {
            array_push($list, [$row->roles, $row->roles]);
        }
        
        return response()->json($list);
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'roles' => 'required',
            'permissions' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        AdminsRoles::create([
            'roles' => $request->roles,
            'permissions' => json_encode($request->permissions)
        ]);
        
        return response()->json(['message' => 'success']);
    }
    
    public function update(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            $role = AdminsRoles::find($row);
            
            if (!$role) {
                return response()->json(['message' => 'document does not exist']);
            }
            
            if ($request->roles) {
                $role->roles = $request->roles;
            }
        
            if ($request->permissions) {
                $role->permissions = json_encode($request->permissions);
            }
            
            $role->save();
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            AdminsRoles::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
}
