<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;
use Modules\College\Entities\College;

class PageListController extends Controller
{
    public function list(Request $request)
    {
        $result = [];
        
        foreach (College::where('name', 'like', $request->text.'%')->orWhere('name', 'like', '% '.$request->text.'%')->get(['name', 'slug']) as $row)
        {
            array_push($result, [$row->name, $row->slug]);
        }
        
        foreach (Blog::where('title', 'like', $request->text.'%')->orWhere('title', 'like', '% '.$request->text.'%')->get(['title', 'slug']) as $row)
        {
            array_push($result, [$row->title, $row->slug]);
        }
        
        return response()->json($result);
    }
}
