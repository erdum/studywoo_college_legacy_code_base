<?php

namespace Modules\Admin\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\SiteConfig as EntitiesSiteConfig;
use Modules\College\Http\Controllers\ImageController;
use Intervention\Image\ImageManagerStatic as Image;
use SystemConfig;

class SiteConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    use RepositoryTrait;
    use ControllerTrait;

    public function index($page = null)
    {
        return view('admin::site-config.index', ['page' => $page]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {


        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function addEditBasicConfig(Request $request)
    {
        try {
            $config = EntitiesSiteConfig::where("name", $request->id)->first() ?? new EntitiesSiteConfig();
            $config->name = $request->id;
            $config->value = $request->data;
            $config->save();

            // remove config from cache
            SystemConfig::refresh();

            return response()->json([
                'message' => "Config Updated"
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function addHomeImage(Request $request)
    {

        if ($request->file('home-image')) {
            $path = "images/college/gallery";
            $file = $request->file('home-image');

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // image filename
            $filename = time() . "." . $file->getClientOriginalExtension();
            $img = Image::make($file);

            $img->resize(1400, 800);

            // saving original image
            $img->save($path . '/' . $filename);

            $homeImage = EntitiesSiteConfig::where("name", "home-image")->first() ?? new EntitiesSiteConfig();
            // if ($homeImage) {
            //     unlink($homeImage->value);
            // }

            $homeImage->name = "home-image";
            $homeImage->value = $path . '/' . $filename;
            $homeImage->save();
        }



        if ($request->file('site-logo')) {
            //for icon

            if (file_exists("logo.png")) {
                unlink("logo.png");
            }
            $iconFile = $request->file('site-logo');

            $iconFile->move(public_path('/'), "logo.png");
        }



        if ($request->file('favicon-icon')) {
            //for favicon
            if (file_exists("favicon.ico")) {
                unlink("favicon.ico");
            }
            $iconFile = $request->file('favicon-icon');

            $iconFile->move(public_path('/'), "favicon.ico");
        }



        SystemConfig::refresh();

        return back()->with("success", "Image uploaded");
    }
}
