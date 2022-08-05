<?php

namespace Modules\Admin\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\SiteConfig;
use Intervention\Image\ImageManagerStatic as Image;
use SystemConfig;

class HomeController extends Controller
{
    use RepositoryTrait;
    use ControllerTrait;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('admin::home.index', ['homeImage' => SiteConfig::where(['name' => 'home-image'])->first()]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('college::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $path = "images/college/gallery";
        $file = $request->file('image');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // image filename
        $filename = time() . "." . $file->getClientOriginalExtension();
        $img = Image::make($file);

        $img->resize(1400, 800);

        // saving original image
        $img->save($path . '/' . $filename);

        $homeImage = SiteConfig::where("name", "home-image")->first() ?? new SiteConfig();
        if ($homeImage) {
            unlink($homeImage->value);
        }

        $homeImage->name = "home-image";
        $homeImage->value = $path . '/' . $filename;
        $homeImage->save();

        SystemConfig::refresh();

        return $this->jsonResponse('Home Image', 200);
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('college::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('college::edit');
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
    public function destroy($id)
    {
        //
    }
}
