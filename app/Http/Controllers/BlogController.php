<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

// Blog Model
use App\Models\Blog;

// Admins Model
use App\Models\Admins;

// Pages Model
use App\Models\Pages;

class BlogController extends Controller
{
    public function index()
    {
        $rows = Blog::all();
        
        foreach ($rows as $row)
        {
            unset($row->cover_image);
            
            $row->posted_by = Admins::where('id', $row->posted_by)->first()->name ?? 'Not Found';

            $date = date('d M Y', strtotime($row->created_at));
            $update_date = date('d M Y', strtotime($row->updated_at));
            
            unset($row->created_at);
            unset($row->updated_at);
            
            $row->date = $date;
            $row->update_date = $update_date;
            
        }
        
        return response()->json($rows);
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required|string',
            'meta_description' => 'required',
            'body' => 'required',
            'cover_image' => 'required',
            'posted_by' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $check_user = Admins::where('id', $request->posted_by)->first();
        
        if (!$check_user) {
            return response()->json(['message' => 'document does not exist']);
        }
        
        $cover_images = [];
        
        foreach ($request->cover_image as $image)
        {
            array_push($cover_images, 'photos/' . $image);
        }
        
        try {
            $blog = Blog::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'posted_by' => $check_user->id,
                'meta_description' => $request->meta_description,
                'body' => $request->body,
                'visits' => 0,
                'cover_image' => json_encode($cover_images)
            ]);
            
        } catch (Exception $e) {
            
            return response()->json(['message' => $e], 400);
            
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function update(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        $check_user = Admins::where('id', $request->posted_by)->first();
        
        $cover_images = [];

        if ($request->cover_image) {
            foreach ($request->cover_image as $image)
            {
                array_push($cover_images, 'photos/' . $image);
            }
        }
        
        foreach($rowsToBeEffected as $row)
        {
            $blog = Blog::find($row);
            
            if (!$blog) {
                return response()->json(['message' => 'document does not exist']);
            }
            
            if ($request->title) {
                $blog->title = $request->title;
            }
            
            if ($request->slug) {
                $blog->slug = $request->slug;
            }
            
            if ($check_user) {
                $blog->posted_by = $check_user->id;
            }
            
            if ($request->meta_description) {
                $blog->meta_description = $request->meta_description;
            }
            
            if ($request->body) {
                $blog->body = $request->body;
            }
            
            if ($cover_images) {
                $blog->cover_image = $cover_images;
            }
            
            $blog->save();
            
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            Blog::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function display(Blog $blog, Request $request)
    {
        $prevPost = null;
        $nextPost = null;
        
        if ($blog->id >= 1) {
            $nextPost = Blog::where('id', (integer) $blog->id + 1)->first();
        }
        
        if ($blog->id > 1) {
            $prevPost = Blog::where('id', (integer) $blog->id - 1)->first();
        }
        
        return view('blog.single-standard', [
            'blog' => $blog,
            'prevPost' => $prevPost,
            'nextPost' => $nextPost,
            
            'page_id' => $blog->slug,
            'user_id' => $request->user()->id ?? '',
            'comment_submit_url' => '/api/comment',
            'review_submit_url' => '/api/review'
        ]);
    }
    
    // public function paginate($page_num = 1)
    // {
    //     $numof_posts = Blog::all()->count();
    //     $popular_posts = Blog::get_popular_posts();
        
    //     if ($page_num <= $numof_posts) {
            
    //         $per_page = 5;
    //         $tab;
            
    //         if (($page_num % $per_page)  == 0) {
    //             $tab = $page_num + $per_page - 1;
    //         } elseif (($page_num / $per_page) < 1) {
    //             $tab = $per_page;
    //         } else {
    //             $tab = ceil($page_num / $per_page) * $per_page;
    //         }
            
    //         return view('blog.index', [
    //             'posts' => $popular_posts,
    //             'current_page' => $page_num,
    //             'numof_posts' => $numof_posts,
    //             'per_page' => $per_page,
    //             'tab' => $tab,
    //         ]);
            
    //     }
        
    //     return response('Not found', 404);
        
    // }
}
