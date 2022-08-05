<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// College Model
use Modules\College\Entities\College;

// Blog Model
use App\Models\Blog;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $result = [];
        
        foreach (College::where('name', 'like', $request->text.'%')->orWhere('name', 'like', '% '.$request->text.'%')->get(['name', 'slug']) as $row)
        {
            array_push($result, (object) array(
                'title' => $row->name,
                'link' => $request->getSchemeAndHttpHost() . '/' . $row->slug
            ));
        }
        
        foreach (Blog::where('title', 'like', $request->text.'%')->orWhere('title', 'like', '% '.$request->text.'%')->get(['title', 'slug']) as $row)
        {
            array_push($result, (object) array(
                'title' => $row->title,
                'link' => $request->getSchemeAndHttpHost() . '/blog/' . $row->slug
            ));
        }
        
        return response()->json($result);
    }
}
