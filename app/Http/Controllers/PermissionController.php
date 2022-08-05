<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{
    public function list()
    {
        $list = [];
        $routeCollection = Route::getRoutes();
        foreach ($routeCollection as $route)
        {
            $url = $route->uri();
            $middleWares = $route->gatherMiddleware();
            
            if (substr($url, 0, 3) == 'api' && in_array('App\\Http\\Middleware\\VerifyPermission', $middleWares)) {
                $name = explode('/', $url);
                $name = end($name);
                array_push($list, $name);
            }
        }
        
        $list = array_unique($list);
        
        $result = [
            ['None', 'none'],
            ['All', 'all']
        ];
        foreach ($list as $index => $item)
        {
            array_push($result, [$item, strtolower($item)]);
        }
        
        return response()->json($result);
        // return $list;
    }
}
