<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

// Reviews Model
use App\Models\Reviews;

// College Model
use Modules\College\Entities\College;

// Blog Model
use App\Models\Blog;

// Admins Model
use App\Models\Admins;

class ReviewsController extends Controller
{
    public function index()
    {
        $rows = Reviews::all();
        
        foreach($rows as $row)
        {
            $row->posted_by = Admins::where('id', $row->posted_by)->first()->name ?? $row->posted_by;
            $row->posted_on = College::where('slug', $row->posted_on)->first()->name ?? Blog::where('slug', $row->posted_on)->first()->title;
        }
        
        return response()->json($rows);
    }
    
    public function reviewFromPublic(Request $request)
    {
        Reviews::create([
            'posted_by' => $request->name . '@' . $request->email,
            'posted_on' => $request->posted_on,
            'body' => $request->body,
            'rating' => $request->rating,
            'approved' => true
        ]);
        
        return redirect()->back();
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'posted_on' => 'required',
            'posted_by' => 'required',
            'body' => 'required',
            'rating' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $check_page = College::where('slug', $request->posted_on)->first() ?? Blog::where('slug', $request->posted_on)->first();
        $check_user = Admins::where('id', $request->posted_by)->first();
        
        if (!$check_page && !$check_user) {
            return response()->json(['message' => 'document does not exist']);
        }
        
        Reviews::create([
            'posted_by' => $check_user->id,
            'posted_on' => $check_page->slug,
            'body' => $request->body,
            'rating' => $request->rating,
            'approved' => $request->approved ?? false
        ]);
        
        return response()->json(['message' => 'success']);
    }
    
    public function update(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        $check_page = College::where('slug', $request->posted_on)->first() ?? Blog::where('slug', $request->posted_on)->first() ?? null;
        
        $check_user = Admins::where('id', $request->posted_by)->first() ?? null;
        
        foreach($rowsToBeEffected as $row)
        {
            $review = Reviews::find($row);
            
            if (!$review) {
                return response()->json(['message' => 'document does not exist']);
            }
            
            if ($check_page) {
                $review->posted_on = $check_page->slug;
            }
            
            if ($check_user) {
                $review->posted_by = $check_user->id;
            }
            
            if ($request->body) {
                $review->body = $request->body;
            }
            
            if ($request->rating) {
                $review->rating = $request->rating;
            }
            
            $review->approved = false;

            if ($request->approved) {
                $review->approved = true;
            }
                
            $review->save();
            
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            Reviews::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
}
