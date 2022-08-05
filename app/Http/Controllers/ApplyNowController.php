<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// College Model
use Modules\College\Entities\College;

// User Application Model
use Modules\Customer\Entities\CustomerApplication;

class ApplyNowController extends Controller
{
    public function index(College $college, Request $request)
    {
        session(['college_id' => $college->id]);
        
        return view('pages.applyNow.index', [
            'college' => $college,
            'username' => $request->user->name ?? ''
        ]);
    }
    
    public function applyNow(College $college){
        
        $user_application = session('user_application');
        
        $additionalData = (object) session('socialLoginAdditionalData');
        
        CustomerApplication::create([
            'college_id' => $college->id,
            'full_name' => $user_application->name,
            'email' => $user_application->email,
            'mobile_number' => $additionalData?->phone,
            'city' => null,
            'course_id' => $additionalData?->course_id
        ]);
        
        return redirect('/profile');
    }
    
    public function get()
    {
        $applications = CustomerApplication::all();
        
        foreach ($applications as $app)
        {
            $app->college_name = $app->college->name;
            $app->course_name = $app->course->name;
        }
        
        return response()->json($applications);
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            CustomerApplication::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
}