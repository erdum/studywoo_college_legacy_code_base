<?php

namespace App\Http\Controllers;


use Modules\College\Entities\College;
use Modules\College\Entities\Course;
use Modules\Customer\Entities\Customer;


class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'totalColleges' => count(College::get()),
            'totalCourses' => count(Course::get()),
            'totalUsers' => count(Customer::get())
        ]);
    }
}