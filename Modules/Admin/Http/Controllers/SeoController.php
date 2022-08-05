<?php

namespace Modules\Admin\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\AdminDetail;
use Modules\Admin\Entities\Seo;
use Modules\Admin\Entities\SiteConfig;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeSubpage;
use SystemConfig;

class SeoController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    public function addEditSeo(Request $request, $parent, $type)
    {

        try {
            if (!$request->id) {
                $model = $this->getCorrespondingModel($type);
                $model = $model->where("id",$request->parent_type_id)->first();
                $model->seo()->create($request->all());
                return $this->jsonResponse('Seo ', 201);
            } else {
                Seo::find($request->id)->update([
                    'meta_title' => $request->meta_title,
                    "meta_description" => $request->meta_description,
                    "meta_keyword" => $request->meta_keyword
                ]);

                return $this->jsonResponse('Seo ', 200, "updated");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function getCorrespondingModel($str)
    {

        switch ($str) {
            case 'college-subpage':
                $model = new CollegeSubpage();
                break;
            case "college-model":
                $model = new College();
                break;
            case "admin-detail":
                $model = new AdminDetail();
                break;
        }
        return $model;
    }

    public function getAddSeoPage()
    {
        //dd(SiteConfig::where('name','home-page-seo')->first());

        if (SiteConfig::where('name', 'home-page-seo')->first() != null)
            $homePageSeo = json_decode(SiteConfig::where('name', 'home-page-seo')->first()->value);
        else
            $homePageSeo = null;

        if (SiteConfig::where('name', 'listing-page-seo')->first() != null)
            $listingPageSeo = json_decode(SiteConfig::where('name', 'listing-page-seo')->first()->value);
        else
            $listingPageSeo = null;

        if (SiteConfig::where('name', 'review-page-seo')->first() != null)
            $reviewPageSeo = json_decode(SiteConfig::where('name', 'review-page-seo')->first()->value) ?? '';
        else
            $reviewPageSeo = null;


        SystemConfig::refresh();
        return view("admin::seo.index")->with('home', $homePageSeo)->with('listing', $listingPageSeo)->with('review', $reviewPageSeo);
    }

    public function addSeoForStatic(Request $request)
    {
        //  dd($request->all());
        $seo = SiteConfig::where('name', $request->id)->first() ?? null;

        $seoData = [
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description
        ];

        if ($seo != '') {
            $seo->value = json_encode($seoData);
            $seo->name = $request->id;
            $seo->update();
        } else {
            SiteConfig::create([
                'name' => $request->id,
                'value' => json_encode($seoData)
            ]);
        }

        return redirect()->route('admin.seo.getAddSeoPage');
    }
}
