<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\College\Entities\College;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Editor\Fields\Select;

class SiteMapXMLController extends Controller
{
    protected  $site_url = 'http://college.studywoo.com';
    public function index() {
        $authors = DB::table('admins')->get();
        $colleges = DB::table('colleges')->latest()->get();
        return response()->view("frontend::sitemap.index", [
            'authors' => $authors,
            'colleges' => $colleges,
            'site_url' => $this->site_url,
        ])->header('Content-Type', 'text/xml');
      }

      public function sitemap_daily() {
        $colleges = DB::table('colleges')->latest()->get();
        return response()->view("frontend::sitemap.sitemap_daily", [
            'colleges' => $colleges,
            'site_url' => $this->site_url,
        ])->header('Content-Type', 'text/xml');
      }

      public function sitemap_weekly() {
        $authors = DB::table('admins')->get();
        return response()->view("frontend::sitemap.sitemap_weekly", [
            'authors' => $authors,
            'site_url' => $this->site_url,
        ])->header('Content-Type', 'text/xml');
      }

      public function sitemap_monthly() {
        return response()->view("frontend::sitemap.sitemap_monthly", [
            'site_url' => $this->site_url,
        ])->header('Content-Type', 'text/xml');
      }
}
