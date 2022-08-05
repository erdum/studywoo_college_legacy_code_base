<?php

namespace App\Helpers;

use App\Models\Cache as ModelsCache;
use Illuminate\Support\Facades\Cache as FacadesCache;
use Modules\Admin\Entities\Cache as EntitiesCache;
use Modules\College\Entities\Affiliated;
use Modules\College\Entities\City;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeProgramType;
use Modules\College\Entities\CollegeType;
use Modules\College\Entities\Course;
use Modules\College\Entities\CourseType;
use Modules\College\Entities\EntranceExam;
use Modules\College\Entities\Program;
use Modules\College\Entities\State;
use Modules\College\Entities\Stream;
use Modules\College\Transformers\CollegeListItem;
use Modules\College\Transformers\CollegeResource;

class Cache
{


    private static $state = "state";
    private static $city = "city";
    private static $course = "course";
    private static $entranceExam = "entranceExam";
    private static $affiliated = "affiliated";
    private static $stream = "stream";
    private static $programType = "programType";
    private static $collegeType = "collegeType";
    private static $courseType = "courseType";


    public static function getCourseList()
    {
        // self::refreshCollegeListing($limit);
        return json_decode(FacadesCache::rememberForever(self::$course, function () {
            // get 6 college with high ratings
            return json_encode((Course::getFilterList()));
        }));
    }

    public static function getStateList()
    {
        // self::refreshCollegeListing($limit);
        return json_decode(FacadesCache::rememberForever(self::$state, function () {
            // get 6 college with high ratings
            return json_encode((State::getFilterList()));
        }));
    }

    public static function getCityList()
    {
        // self::refreshCollegeListing($limit);
        return json_decode(FacadesCache::rememberForever(self::$city, function () {
            // get 6 college with high ratings
            return json_encode((City::getFilterList()));
        }));
    }

    public static function getEntranceExamList()
    {
        // self::refreshCollegeListing($limit);
        return json_decode(FacadesCache::rememberForever(self::$entranceExam, function () {
            // get 6 college with high ratings
            return json_encode((EntranceExam::all()));
        }));
    }


    public static function getAffiliatedList()
    {
        // self::refreshCollegeListing($limit);
        return json_decode(FacadesCache::rememberForever(self::$affiliated, function () {
            // get 6 college with high ratings
            return json_encode((Affiliated::all()));
        }));
    }


    public static function getStreamList()
    {
        // self::refreshCollegeListing($limit);
        return json_decode(FacadesCache::rememberForever(self::$stream, function () {
            // get 6 college with high ratings
            return json_encode((Stream::all()));
        }));
    }

    public static function getProgramTypeList()
    {
        // self::refreshCollegeListing($limit);
        return json_decode(FacadesCache::rememberForever(self::$programType, function () {
            // get 6 college with high ratings
            return json_encode((Program::all()));
        }));
    }

    public static function getCollegeTypeList()
    {
        // self::refreshCollegeListing($limit);
        return json_decode(FacadesCache::rememberForever(self::$collegeType, function () {
            // get 6 college with high ratings
            return json_encode((CollegeType::all()));
        }));
    }

    public static function getCourseTypeList()
    {
        // self::refreshCollegeListing($limit);
        return json_decode(FacadesCache::rememberForever(self::$courseType, function () {
            // get 6 college with high ratings
            return json_encode((CourseType::all()));
        }));
    }

    public static function refreshCollegeListing($limit = 12)
    {
        FacadesCache::forget(self::$state);
        FacadesCache::forget(self::$city);
    }


    public static function collegeObserver($slug)
    {
        self::createOrUpdateCollegeCache($slug);
        self::refreshCollegeListing(12);
        // self::refreshPopularCollege();
        return;
    }

    public static function getCollegeCache($slug)
    {
        $college = EntitiesCache::where("slug", $slug)->first();
        if ($college)
            return json_decode($college['data']);
        else {
            self::createOrUpdateCollegeCache($slug);
            $college = EntitiesCache::where("slug", $slug)->first();
            return json_decode($college['data']);
        }
    }


    public static function createOrUpdateCollegeCache($slug)
    {
        $college = College::where("slug", $slug)->first();
        $college = new CollegeResource($college);
        $cacheCollege = EntitiesCache::where('slug', $slug)->first();
        if ($cacheCollege) {
            $cacheCollege->update([
                'slug' => $slug,
                'data' => json_encode($college)
            ]);
        } else
            ModelsCache::insert([
                'slug' => $slug,
                'data' => json_encode($college)
            ]);
        return;
    }
}
