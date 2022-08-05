<?php


use Illuminate\Support\Facades\Cache;
use Modules\Admin\Entities\SiteConfig as EntitiesSiteConfig;

use Illuminate\Support\Str;

if (!function_exists("hasPermission")) {

    function hasPermission($value)
    {
        //return true;
        if (is_array($value)) {
            if (isset($value['permission'])) {

                // slug
                if (in_array(Str::slug($value['permission']), json_decode(auth()->user()->adminDetail->permissions) ?? [])) {
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        } else {
            if (in_array(Str::slug($value), json_decode(auth()->user()->adminDetail->permissions) ?? [])) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

}

if (!function_exists('checkMiddleware')) {
    function checkMiddleware($permission){
        if (in_array(Str::slug($permission), json_decode(auth()->user()->adminDetail->permissions) ?? [])) {
            return true;
        } else {
            return abort(403);
        }
    }
}

class SystemConfig
{

    public static function get(string $key, $default = null)
    {
        // self::refresh();
        $config = self::getConfigCache();
        return $config[$key] ?? $default;
    }

    private static function getConfigCache()
    {
        return Cache::rememberForever('system_config', function () {
            return (EntitiesSiteConfig::select('name', 'value')->get()->keyBy('name')->pluck('value', 'name')->toArray());
        });
    }

    public static function refresh()
    {
        Cache::forget('system_config');
        return self::getConfigCache();
    }
}
