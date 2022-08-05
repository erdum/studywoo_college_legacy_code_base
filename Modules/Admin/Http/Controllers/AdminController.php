<?php

namespace Modules\Admin\Http\Controllers;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Modules\Admin\Emails\EmailVerification;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\AdminDetail;
use Modules\College\Entities\College;
use Modules\College\Entities\Course;
use Modules\Customer\Entities\Customer;

class AdminController extends Controller
{
    use ControllerTrait;
    use RepositoryTrait;

    private $needEmailVerify = true;

    private $isRegisterAllowed = true;

    public function index()
    {
        // dd("sdjsbf");
        $collegesCount = count(College::get());
        $courseCount = count(Course::get());
        $customersCount = count(Customer::get());
        $visitors = 100;

        return view(
            'admin::index',
            [
                'collegesCount' => $collegesCount,
                'courseCount' => $courseCount,
                'customersCount' => $customersCount,
                'visitors' => $visitors
            ]
        );
    }

    public function getRegister()
    {
        return view('admin::Auth.register');
    }


    public function getLogin()
    {
        return view('admin::Auth.login');
    }


    public function postRegister(Request $request)
    {
        if ($request->id) {
            $admin = Admin::find($request->id)->adminDetail->update(['permissions' => $request->permissions]);
            return $this->jsonResponse('User', 200, "Updated");
        }

        $login_data = [
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'username' => random_int(10000, 99999) . "-" . $request->first_name . "-" . $request->last_name
        ];

        $login = Admin::create($login_data);

        $register_data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'permissions' => json_encode($request->permissions),
            'avatar' => "https://ui-avatars.com/api/?name=" . $request->first_name . '+' . $request->last_name,
            'admin_id' => $login->id
        ];

        $register = AdminDetail::create($register_data);

        return $this->jsonResponse('User', 201);
        return back();
        // auto login
        // return $this->postLogin($request);


        // if ($this->needEmailVerify)
        //     return redirect()->route('admin.auth.getVerifyMessage');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ])) {
            return redirect()->route('admin.dashboard');
        }
        return back()->with(['err-message' => "Login Credentials is invalid"]);
    }

    public function logout()
    {
        Auth::logout();
        return view('admin::Auth.logout');
    }

    public function getVerifyMessage()
    {
        //  Generate temp url
        $url = URL::temporarySignedRoute(
            'admin.auth.verifyEmail',
            now()->addMinutes(5),
            ['user' => auth()->user()->email]
        );


        Mail::send('admin::email.email-verify', ['url' => $url], function ($message) {
            $message->to(auth()->user()->email, "User / Client Name")
                ->subject("Email Verification");
            $message->from("dumpemail@cpanelnepal.com", "Site name");
        });
        return view('admin::auth.email-verify-message', ['email' => auth()->user()->email]);
    }



    public function verifyEmail(Admin $user)
    {
        $user->email_verified_at = date('Y-m-d @ h:i:sa');
        $user->save();
        return redirect()->route('admin.dashboard');
    }

    public function getForgotPassword()
    {
        return view('admin::Auth\forgot-password');
    }

    public function postForgotPassword(Request $request)
    {
        //  Generate temp url
        $url = URL::temporarySignedRoute(
            'admin.auth.verifyForgotPassword',
            now()->addMinutes(5),
            ['user' => $request->email]
        );

        Mail::send('admin::email.forgot-password', ['url' => $url], function ($message) use ($request) {
            $message->to($request->email, "User / Client Name")
                ->subject("Email Verification");
            $message->from("dumpemail@cpanelnepal.com", "Site name");
        });
        return view('admin::auth.email-verify-message', ['email' => $request->email]);
    }

    public function verifyForgotPassword(Admin $user)
    {
        session()->put('password-reset', $user->email);
        return view('admin::Auth\password-reset');
    }

    public function resetPassword(Request $request)
    {
        $email = session()->pull('password-reset');

        $user = Admin::where('email', $email)->first() ?? null;
        if ($user) {
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->route('admin.auth.login');
        }
        dd($request->all());
    }

    public function changeStatus($id)
    {
        $admin = Admin::where('id', $id)->first();
        if ($admin->status) {
            $admin->status = 0;
        } else {
            $admin->status = 1;
        }
        $admin->save();
        return back();
    }
}
