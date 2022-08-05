<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

// Pages Model
use App\Models\Pages;

// College Model
use Modules\College\Entities\College;

// Blog Model
use App\Models\Blog;

class SeoController extends Controller
{
    public function index()
    {
        return response()->json(Pages::all());
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'page' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $check_page = College::where('slug', $request->page)->first() ?? Blog::where('slug', $request->page)->first();
        
        if (!$check_page) {
            return response()->json(['message' => 'document does not exist']);
        }
        
        Pages::create([
            'title' => $request->title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'page_id' => $check_page->slug
        ]);
        
        return response()->json(['message' => 'success']);
    }
    
    public function update(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        $check_page = College::where('slug', $request->page)->first() ?? Blog::where('slug', $request->page)->first() ?? null;
        
        foreach($rowsToBeEffected as $row)
        {
            $page = Pages::find($row);
            
            if (!$page) {
                return response()->json(['message' => 'document does not exist']);
            }
            
            if ($request->title) {
                $page->title = $request->title;
            }
            
            if ($request->meta_description) {
                $page->meta_description = $request-meta_description;
            }
            
            if ($request->meta_keywords) {
                $page->meta_keywords = $request->meta_keywords;
            }
            
            $page->save();
            
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            Pages::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
}
