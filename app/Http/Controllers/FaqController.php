<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

// Faq Model
use App\Models\Faq;

// College Model
use Modules\College\Entities\College;

// Blog Model
use App\Models\Blog;

class FaqController extends Controller
{
    public function index()
    {
        $rows = Faq::all();
        
        foreach($rows as $row)
        {
            $row->posted_on = College::where('slug', $row->posted_on)->first()->name ?? Blog::where('slug', $row->posted_on)->first()->title;
        }
        
        return response()->json($rows);
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'posted_on' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $check_page = College::where('slug', $request->posted_on)->first() ?? Blog::where('slug', $request->posted_on)->first();
        
        if (!$check_page) {
            return response()->json(['message' => 'document does not exist']);
        }
        
        Faq::create([
            'posted_on' => $check_page->slug,
            'question' => $request->question,
            'answer' => $request->answer
        ]);
        
        return response()->json(['message' => 'success']);
    }
    
    public function update(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        $validator = Validator::make($request->all(), [
            'posted_on' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $check_page = College::where('slug', $request->posted_on)->first() ?? Blog::where('slug', $request->posted_on)->first();
        
        foreach($rowsToBeEffected as $row)
        {
            $faq = Faq::find($row);
            
            if (!$faq) {
                return response()->json(['message' => 'document does not exist']);
            }
            
            if ($check_page) {
                $faq->posted_on = $check_page->slug;
            }
            
            if ($request->question) {
                $faq->question = $request->question;
            }
            
            if ($request->answer) {
                $faq->answer = $request->answer;
            }
            
            $faq->save();
            
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            Faq::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
}
