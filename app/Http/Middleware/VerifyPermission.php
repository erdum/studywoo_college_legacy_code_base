<?php

namespace App\Http\Middleware;

use Closure;

// Admins Model
use App\Models\Admins;

// Roles Model
use App\Models\AdminsRoles;

use App\Controllers\PermissionController;

class VerifyPermission
{
    public function handle($request, Closure $next)
    {
        $userRole = $request->user()->roles;
        
        $userPermission = AdminsRoles::where('roles', $userRole)->first()->permissions;
        $userPermission = json_decode($userPermission);
        
        $requestedResource = explode('/', $request->path());
        $requestedResource = end($requestedResource);
        $requestedResource = strtolower($requestedResource);
        
        foreach ($userPermission as $permission)
        {
            if ($permission == 'none') break;
            
            if ($permission == $requestedResource || $permission == 'all') {
                return $next($request);
            }
        }
        
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}