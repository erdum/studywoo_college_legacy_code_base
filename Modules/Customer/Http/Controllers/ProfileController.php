<?php

namespace Modules\Customer\Http\Controllers;

// use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
// use Illuminate\Routing\Route;
use Modules\College\Entities\City;
use Modules\College\Entities\State;
// use Modules\Customer\Entities\CustomerDetail;
// use Modules\Customer\Entities\CustomerEducationalDetail;
// use Modules\Customer\Http\Requests\CreateEducationalDetailRequest;
// use Modules\Customer\Http\Requests\CreateProfileRequest;
// use Intervention\Image\ImageManagerStatic as Image;
use App\Models\PersonalAccessToken;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        return view('customer::profile',[
            'user' => $request->user(),
            'step' => $request->step ?? 1,
            'states' => State::all(),
            'cities' => City::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    // public function create()
    // {
    //     return view('customer::create');
    // }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    // public function store(CreateProfileRequest $request)
    // {
    //     //dd($request->all());
    //     if($request->hasFile('avatar')){
    //         $thumb_path =   'images/customer/avatar/thumb';
    //         if (!file_exists('images/customer/avatar')) {
    //             mkdir('images/customer/avatar', 0777, true);
    //         }

    //         if (!file_exists($thumb_path)) {
    //             mkdir($thumb_path, 0777, true);
    //         }

    //         // image filename
    //         $filename = time() . "." . $request->file('avatar')->getClientOriginalExtension();
    //         $img = Image::make($request->file('avatar'));

    //         // saving original image
    //         $img->save('images/customer/avatar' . '/' . $filename);

    //         // resize the image so that the largest side fits within the limit; the smaller
    //         // side will be scaled to maintain the original aspect ratio
    //         $img->resize(96, 96, function ($constraint) {
    //             $constraint->aspectRatio();
    //             $constraint->upsize();
    //         });

    //         //      saving thumbnail image
    //         $img->save($thumb_path . '/' . $filename);
    //         $path='images/customer/avatar/thumb'.'/'. $filename;
    //     }
    //     else{
    //         $path=auth()->guard('customer')->user()->customerDetail->avatar;
    //     }



    //     $customer_id=(auth()->guard('customer')->user()->customerDetail->customer_id);
    //     $customer=CustomerDetail::get()->where('customer_id',$customer_id)->first();
    //   // dd($customer);
    //     $customer->first_name=$request->first_name;
    //     $customer->last_name=$request->last_name;
    //     $customer->phone=$request->phone;
    //     $customer->date_of_birth=$request->date_of_birth;
    //     $customer->city_id=$request->city_id;
    //     $customer->state_id=$request->state_id;
    //     $customer->gender=$request->gender;
    //     $customer->address=$request->address;
    //     $customer->pincode=$request->pin_code;
    //     $customer->detail=$request->detail;
    //     $customer->avatar=$path;
    //     $customer->save();

    //     return redirect('/customer/profile?step=2');

    // }

    // /**
    //  * Show the specified resource.
    //  * @param int $id
    //  * @return Renderable
    //  */
    // public function show($id)
    // {
    //     return view('customer::show');
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  * @param int $id
    //  * @return Renderable
    //  */
    // public function edit($id)
    // {
    //     return view('customer::edit');
    // }

    // /**
    //  * Update the specified resource in storage.
    //  * @param Request $request
    //  * @param int $id
    //  * @return Renderable
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    // public function destroy($id)
    // {
    //     //
    // }


    // public function postProfileEducationalDetail(CreateEducationalDetailRequest $request){

    //   $data=$request->validated();
    //   //dd($data);

    //  //   dd($request->validated());
    //  $customer_id=(auth()->guard('customer')->user()->customerDetail->customer_id);
    //  $customer=CustomerEducationalDetail::get()->where('customer_id',$customer_id)->first();
    //     // CustomerEducationalDetail::create([
    //     //     'tenth_passing_year'=>$data['tenth_passing_year'],
    //     //     'tenth_grading_system'=>$data['tenth_grading_system'],
    //     //     'tenth_marks'=>$data['tenth_marks'],
    //     //     'twelve_passing_year'=>$data['twelve_passing_year'],
    //     //     'twelve_grading_system'=>$data['twelve_grading_system'],
    //     //     'twelve_marks'=>$data['twelve_marks'],
    //     //     'grad_passing_year'=>$data['grad_passing_year'],
    //     //     'grad_grading_system'=>$data['grad_grading_system'],
    //     //     'grad_marks'=>$data['grad_marks'],
    //     //     'detail'=>$data['detail'],
    //     //     'customer_id'=>auth()->guard('customer')->user()->id

    //     // ]);
    //     //return redirect()->route('profile');
    //     $customer->tenth_passing_year=$data['tenth_passing_year'];
    //     $customer->tenth_grading_system=$data['tenth_grading_system'];
    //     $customer->tenth_marks=$data['tenth_marks'];
    //     $customer->twelve_passing_year=$data['twelve_passing_year'];
    //     $customer->twelve_grading_system=$data['twelve_grading_system'];
    //     $customer->twelve_marks=$data['twelve_marks'];
    //     $customer->grad_passing_year=$data['grad_passing_year'];
    //     $customer->grad_grading_system=$data['grad_grading_system'];
    //     $customer->grad_marks=$data['grad_marks'];
    //     $customer->detail=$data['detail'];
    //     $customer->save();
    //     return redirect()->route('profile');


    // }
}
