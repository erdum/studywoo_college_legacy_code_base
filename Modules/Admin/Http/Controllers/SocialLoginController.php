<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\AdminDetail;

class SocialLoginController extends Controller
{
    public function handleCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        return $this->createOrLoginUser($user);
    }


    public function createOrLoginUser($user)
    {
        $admin = Admin::where('email', $user->getEmail())->first();
        if (!$admin) {
            // login
            $admin = Admin::create(
                [
                    'provider_id' => $user->getId(),
                    'email' => $user->getEmail(),
                ]
            );
            // register
            AdminDetail::create(
                [
                    'name' => $user->getName(),
                    'avatar' => $user->getAvatar(),
                    'admin_id' => $admin->id
                ]
            );
        }

        Auth::login($admin);

        return redirect()->route('admin.dashboard');
    }
}
