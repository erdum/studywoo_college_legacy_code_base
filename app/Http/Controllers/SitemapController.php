<?php

namespace App\Http\Controllers;

set_time_limit(0);

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\Blog;
use Modules\College\Entities\CollegeSubpage;

class SitemapController extends Controller
{
    public function daily(Request $request)
    {
        $records = CollegeSubpage::where('slug', 'info')->whereDate('updated_at', '>=', Carbon::now()->subHours(24)->format('Y-m-d'))->where('updated_at', '<', Carbon::now()->subHours(0)->format('Y-m-d'))->get()->unique('college_id');

        return response()->view('sitemap.sitemap', [
            'posts' => $records,
        ])->header('Content-Type', 'text/xml');
    }
    
    public function weekly(Request $request)
    {
        $records = CollegeSubpage::where('slug', 'info')->whereDate('updated_at', '>=', Carbon::now()->subHours(24 * 7)->format('Y-m-d'))->where('updated_at', '<', Carbon::now()->subHours(24)->format('Y-m-d'))->get()->unique('college_id');

        return response()->view('sitemap.sitemap', [
            'posts' => $records
        ])->header('Content-Type', 'text/xml');
    }
    
    public function monthly(Request $request)
    {
        $records = CollegeSubpage::where('slug', 'info')->whereDate('updated_at', '>=', Carbon::now()->subHours(24 * 30)->format('Y-m-d'))->where('updated_at', '<', Carbon::now()->subHours(24 * 7)->format('Y-m-d'))->get()->unique('college_id');

        return response()->view('sitemap.sitemap', [
            'posts' => $records
        ])->header('Content-Type', 'text/xml');
    }
    
    public function yearly(Request $request)
    {
        $records = CollegeSubpage::where('slug', 'info')->whereDate('updated_at', '>=', Carbon::now()->subHours(24 * 365)->format('Y-m-d'))->where('updated_at', '<', Carbon::now()->subHours(24 * 30)->format('Y-m-d'))->get()->unique('college_id');

        return response()->view('sitemap.sitemap', [
            'posts' => $records
        ])->header('Content-Type', 'text/xml');
    }
}
