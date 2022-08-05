<?php

namespace Modules\Customer\Http\Controllers;

use CreateEntranceExamsTable;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Customer\Entities\Customer;
use Modules\Customer\Entities\CustomerDetail;
use Modules\Customer\Entities\CustomerEducationalDetail;
use Modules\Customer\Http\Requests\CreateEducationalDetailRequest;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Entities\SiteConfig;
use Illuminate\Support\Facades\Mail;
use Modules\College\Entities\College;
use Modules\Customer\Entities\CustomerApplication;
use SystemConfig;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('customer::index');
    }

    public function postLogin(Request $request)
    {
        //dd($request->all());
        if (Auth::guard("customer")->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ])) {
            return redirect()->intended('/customer/profile');
        }
        else{
        $request->session()->flash('error', 'Invalid Login Credentials');
        return redirect()->route('login');
        }
    }

    public function register(Request $request)
    {
        $request->session()->forget('error');
        $user= Customer::where('email', $request->email)->first();
        if($user!=null){
            $request->session()->flash('error', 'This email is already registered.');
           // $request->session()->push('data',$request->all());
            return redirect()->route('register');
        };

        $login_data = [
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_name'=> random_int(10000 , 99999) . "-" . $request->first_name . "-". $request->last_name
        ];


        $login = Customer::create($login_data);

        $register_data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'customer_id' => $login->id,
            'avatar' => "https://ui-avatars.com/api/?name=" . $request->first_name . "+" . $request->last_name,
        ];

        //dd($register_data);

        $register = CustomerDetail::create($register_data);
        $register = CustomerEducationalDetail::create(['customer_id' => $login->id]);



        //autologin
        return $this->postLogin($request);
    }

    public function verifyOTP(Request $request)
    {
        // dd($request->all());
        if (Hash::check($request->code, auth()->guard("customer")->user()->otp->last()->code)) {
            auth()->guard("customer")->user()->email_verified_at = date("Y-m-d h:m:s");
            auth()->guard("customer")->user()->save();
            return redirect()->intended('/customer/profile');
        }
        // if (($request->code == auth()->guard("customer")->user()->otp->last()->code)) {
        //     auth()->guard("customer")->user()->email_verified_at = date("Y-m-d h:m:s");
        //     auth()->guard("customer")->user()->save();
        //     return redirect()->intended('/customer/profile');
        // }
        return back()->with("error", "Invalid Code");
    }

    public function logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('login');
    }

    public function getEmailVerify(){

        return view('frontend::pages.forgotPassword.emailVerification');
    }

    public function getOtpVerification(){

        return view('frontend::pages.forgotPassword.otpVerification');
    }

    public function getChangePassword(){
        //$request->session()->flush();
        return view('frontend::pages.forgotPassword.passwordChange');
    }

    public function postEmailVerify(Request $request){
        $user= Customer::where('email',$request->email)->first();
        if($user==null){
            $request->session()->flash('error','Sorry! We cannot find your account.');
            return view('frontend::pages.forgotPassword.emailVerification');
        }
        else{
           // dd($request->email);
            $code = random_int(100000, 999999);
           // dd(env('MAIL_FROM_ADDRESS'));
            Mail::send('frontend::pages.forgotPassword.otpMail', ['otp'=>$code], function ($message) use($request){
                $message->to($request->email,'')
                    ->subject("OTP Verification");
                $message->from(env('MAIL_FROM_ADDRESS'),  SystemConfig::get('app-name') );

            });
            // $request->session->flush() ;
            $request->session()->put('email', $request->email);
            $request->session()->put('code',$code);
            $request->session()->flash('success','Please check your email and enter the OTP.');
            return view('frontend::pages.forgotPassword.otpVerification');

        }
    }

    public function postOtpVerification(Request $request){

        $email=$request->session()->pull('email');
        $code=$request->session()->pull('code');



      // dd($code);


        if($request->otp==$code){
           // dd("yes");
            $request->session()->put('email', $email);
            return view('frontend::pages.forgotPassword.passwordChange');
        }
        else{
            $request->session()->forget('success');
            $request->session()->put('email', $email);
            $request->session()->flash('error', 'Sorry! Invalid OTP');
            return view('frontend::pages.forgotPassword.otpVerification');
        }
    }

    public function postChangePassword(Request $request){
        $email=$request->session()->pull('email');
        //dd($email);
        $user=Customer::where('email',$email)->first();
        $user->password= bcrypt($request->password);
        $user->update();
        return view('frontend::pages.login.index');
    }

    public function getApplyNowForm(College $college){
      //  dd($college);
        return view('frontend::pages.applyNow.index')->with('college', $college);
    }

    public function applyNow(College $college, Request $request){
        //dd($request->all());
        if(auth()->guard('customer')->user()){
           
            CustomerApplication::create([
                'college_id'=>$college->id,
                'full_name'=> auth()->guard('customer')->user()->customerDetail->full_name ,
                'email'=> auth()->guard('customer')->user()->email,
                'mobile_number'=> auth()->guard('customer')->user()->customerDetail->phone,
                'city'=> auth()->guard('customer')->user()->customerDetail->address,
                'course_id'=>$request->course_id
            ]);
        }
        else{

            CustomerApplication::create([
            'college_id'=>$college->id,
            'full_name'=> $request->name,
            'email'=>$request->email,
            'mobile_number'=>$request->phone,
            'city'=>$request->city,
            'course_id'=>$request->course_id,
        ]);
        }
        return redirect()->route('collegeDetail',['college'=>$college->slug]);
    }

public function reviewStatus(Request $request)
    {
        $review_status = $request->status;
        $token = $request->_token;
        $checkbox_IDs = $request->checkbox_ids;
        foreach($checkbox_IDs as $checkbox){
            DB::table('customer_reviews')->where('id','=',$checkbox)->update(['review_status' => $review_status]);
        }
        return response()->json($checkbox_IDs);
    }


}
