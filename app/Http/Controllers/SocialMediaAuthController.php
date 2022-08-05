<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use finfo;

// Admins Model
use App\Models\Admins;

use App\Http\Controllers\FileUploadController;

class SocialMediaAuthController extends Controller
{
    
    public function handleAuth($provider, Request $request)
    {
        session(['socialLoginAdditionalData' => $request->query()]);
        
        return Socialite::driver($provider)->redirect();
    }
    
    public function callback($provider)
    {
        try {
            
            $provider_user = Socialite::driver($provider)->user();
            session(['user_application' => $provider_user]);
            
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            
            $type = $finfo->buffer(file_get_contents($provider_user->avatar));
            $type = explode('/', $type)[1];
            
            $imageConverter = new FileUploadController();
            
            $imageConverter->saveToWebp($provider_user->avatar, 'photos/' . $provider_user->email . '.webp', $type);
            
            $local_user = Admins::where('provider_id', $provider_user->id)->first();
            
            if ($local_user) {
                
                $local_user->avatar = $provider_user->email;

                $local_user->save();
                
                $token = $local_user->createToken('auth_token')->plainTextToken;
                
                if (array_key_exists('course_id', session('socialLoginAdditionalData'))) {
                    return redirect()->route('postApply', ['college' => session('socialLoginAdditionalData')['college_id']]);
                }
                
                return redirect('/profile')->cookie('access_token', $token, 1440);
            }
            
            $local_user = Admins::create([
                'name' => $provider_user->name,
                'email' => $provider_user->email,
                'password' => '123456',
                'roles' => 'User',
                'status' => true,
                'avatar' => $provider_user->email,
                'provider_id' => $provider_user->id
            ]);
            
            $token = $local_user->createToken('auth_token')->plainTextToken;

            if (array_key_exists('college_id', session('socialLoginAdditionalData'))) {
                return redirect()->route('postApply', ['college' => session('socialLoginAdditionalData')['college_id']]);
            }

            return redirect('/profile')->cookie('access_token', $token, 1440);

        } catch (Exception $e) {
            
            return response()->json($e->getMessage(), 500);
            
        }
    }
}
