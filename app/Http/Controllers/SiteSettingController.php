<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Models\SiteSetting;

class SiteSettingController extends Controller
{
    public function changeImages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'names' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $settings = SiteSetting::where('name', 'home_page_images')->first();
        
        if ($settings) {
            
            $settings->settings = json_encode($request->names);
            $settings->save();
            
        } else {
            
            SiteSetting::create([
                'name' => 'home_page_images',
                'settings' => json_encode($request->names)
            ]);
            
        }
        
        return response()->json(['message' => 'success']);
        
    }
    
    public function updateCustomHtml(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'custom_html' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        $settings = SiteSetting::where('name', 'custom_html')->first();
        
        if ($settings) {
            
            $settings->settings = json_encode($request->custom_html);
            $settings->save();
            
        } else {
            
            SiteSetting::create([
                'name' => 'custom_html',
                'settings' => json_encode($request->custom_html)
            ]);
            
        }
        
        return response()->json(['message' => 'success']);
    }
}
