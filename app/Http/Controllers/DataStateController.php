<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use Modules\College\Entities\State;

class DataStateController extends Controller
{
    public function index()
    {
        return response()->json(State::all());
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        State::create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);
        
        return response()->json(['message' => 'success']);
        
    }
    
    public function update(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            $row_data = Stream::find($row);
            
            if (!$row_data) {
                return response()->json(['message' => 'document does not exist']);
            }
            
            if ($request->name) {
                $row_data->name = $request->name;
            }
            
            if ($request->slug) {
                $row_data->slug = $request->slug;
            }
            
            $row_data->save();
            
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            State::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
}