<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use Modules\College\Entities\College;

class LogosController
{
    public function index(Request $request)
    {
        // if ($request->q) {
        //     $rows = College::where('name', 'LIKE', '%' . $request->q . '%')->orWhere('slug', 'LIKE', '%' . $request->q . '%')->get();
            
        //     return response()->json($rows);
        // }
        
        // $rows_per_page = 50;
        // $page = $request->query();
        // $page = $page['page'] ?? 0;
        
        // if ($page >= 0) {
        //     $count = College::count();
        //     $rows = College::offset($page * $rows_per_page)->limit($rows_per_page)->get(['id', 'name', 'logo_path']);
        // }
        
        return response()->json(College::all(['id', 'name', 'logo_path']));
    }
    
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'logo' => 'required',
            'college_id' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors());
        }
        
        $college = College::find($request->college_id);
        
        if (!$college) return response()->json(['message' => 'Document not found'], 404);
        
        $college->logo_path = $request->logo;
        
        $college->save();
        
        return response()->json(['message' => 'success']);
    }
}