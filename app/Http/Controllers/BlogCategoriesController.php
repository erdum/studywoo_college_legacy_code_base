<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// BlogCategories Model
use App\Models\Blog_Categories;

class BlogCategoriesController extends Controller
{
    public function index()
    {
        return response()->json(Blog_Categories::all());
    }
    
    public function list()
    {
        $list = [];
        $rows = Blog_Categories::all();
        
        foreach($rows as $row)
        {
            array_push($list, $row->title);
        }
        
        return response()->json($list);
    }
    
    public function create(Request $request)
    {
        if ($request->title) {
            $category = new Blog_Categories;
            $category->title = $request->title;
            $category->blogs_id = json_encode([]);
            $category->save();
            
            return response()->json(['message' => 'success']);
        }
        
        return response()->json(['message' => 'request data not found !']);

    }
    
    public function update(Request $request)
    {
        if ($request->rows && $request->title) {
            
            $rowsToBeEffected = $request->rows;
            foreach($rowsToBeEffected as $row)
            {
                $category = Blog_Categories::find($row);
                $category->title = $request->title;
                $category->save();
            }
            
            return response()->json(['message' => 'success']);
        }
        
        return response()->json(['message' => 'request data not found !']);
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            Blog_Categories::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
}
