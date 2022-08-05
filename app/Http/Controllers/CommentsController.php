<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

// Comments Model
use App\Models\Comments;

// College Model
use Modules\College\Entities\College;

// Blog Model
use App\Models\Blog;

// Admins Model
use App\Models\Admins;

class CommentsController extends Controller
{
    public function index()
    {
        $rows = Comments::all();
        
        foreach($rows as $row)
        {
            $row->posted_by = Admins::where('id', $row->posted_by)->first()->name ?? $row->posted_by;
            $row->posted_on = College::where('slug', $row->posted_on)->first()->name ?? Blog::where('slug', $row->posted_on)->first()->title;
        }
        
        return response()->json($rows);
    }
    
    public function commentFromPublic(Request $request)
    {
        Comments::create([
            'posted_by' => $request->name . '@' . $request->email,
            'posted_on' => $request->posted_on,
            'body' => $request->body,
            'approved' => true
        ]);
        
        return redirect()->back();
    }
    
    public function update(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        $check_page = College::where('slug', $request->posted_on)->first() ?? Blog::where('slug', $request->posted_on)->first() ?? null;
        
        $check_user = Admins::where('id', $request->posted_by)->first() ?? null;
        
        foreach($rowsToBeEffected as $row)
        {
            $comment = Comments::find($row);
            
            if (!$comment) {
                return response()->json(['message' => 'document does not exist'], 404);
            }
            
            $comment->approved = false;
            
            if ($request->approved) $comment->approved = true;
            
            if ($request->reply) $comment->reply = $request->reply;
            
            $comment->save();
            
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            Comments::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
}
