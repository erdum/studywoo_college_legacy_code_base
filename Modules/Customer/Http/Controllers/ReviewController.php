<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeSubpage;
use Modules\College\Http\Repository\CollegeRepository;
use Modules\Customer\Entities\CustomerReview;
use Modules\Customer\Http\Requests\CreateReviewRequest;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        // customer panel review list
        $reviews = CustomerReview::where('customer_id', auth()->guard('customer')->user()->id)->get();
        // dd($reviews);
        return view('customer::review')->with('reviews', $reviews);
    }



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function getReviewPage()
    {

        //$college = College::where('slug', $slug)->first();
        return view("frontend::pages.review.index")->with('colleges', College::all());
    }

    public function saveReview(CreateReviewRequest $request)
    {

        $data = $request->validated();
        //dd($request->validated());
        $college=College::where('id', $data['college_id'])->first();
        $slug= auth()->guard('customer')->user()->user_name . ' review on ' . $college->name;
        $slug= Str::slug($slug);
        //dd($slug);
        $average_rating = ($data['faculty'] + $data['placement'] + $data['social_life'] +
            $data['interview'] + $data['internship']
            + $data['hostel'] + $data['course']) / 7;

        CustomerReview::create([
            'college_id' => $data['college_id'],
            'customer_id' => auth()->guard('customer')->user()->id,
            'title' => $data['title'],
            'slug'=>$slug,
            'description' => $data['description'],
            'faculty' => $data['faculty'],
            'course' => $data['course'],
            'internship' => $data['internship'],
            'interview' => $data['interview'],
            'hostel' => $data['hostel'],
            'social_life' => $data['social_life'],
            'placement' => $data['placement'],
            'average_rating' => $average_rating

        ]);
        CollegeRepository::dispatcher($data['college_id']);
        return back();
    }
}
