<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use Modules\College\Entities\College;
use Modules\College\Entities\State;
use Modules\College\Entities\City;
use Modules\College\Entities\Course;
use Modules\College\Entities\CollegeCourse;
use Modules\College\Entities\EntranceExam;
use Modules\College\Entities\CollegeEntranceExam;
use Modules\College\Entities\Affiliated;
use Modules\College\Entities\CollegeAffiliated;
use Modules\College\Entities\Stream;
use Modules\College\Entities\CollegeStream;
use Modules\College\Entities\Program;
use Modules\College\Entities\CollegeProgramType;
use Modules\College\Entities\CollegeType;
use Modules\College\Entities\CollegeCollegeType;
use Modules\College\Entities\CourseType;
use Modules\College\Entities\CollegeCourseType;

use App\Models\Reviews;
use App\Models\Author;

use Validator;

class CollegeController extends Controller
{
    public static function check_and_save($value, $row, $name = null, $callback = null)
    {
        if ($value) {
            if ($name) $row->{$name} = $value;
            if ($callback) $callback();
        }
    }
    
    private function save_multiple_values($model, $ids, $id_name, $college_id)
    {
        if ($ids && $model && $id_name && $college_id) {
            try {
                $model::where('college_id', $college_id)->delete();
                
                foreach ($ids as $id)
                {
                    $model::create([
                        'college_id' => $college_id,
                        $id_name => $id
                    ]);
                }
            } catch (Excception $e) {
                return $e;
            }
        }
        
        return true;
    }
    
    private function fetch_multiple_values($model, $ids, $id_name)
    {
        $result = [];
        
        foreach ($ids as $id)
        {
            $row = $model::where('id', $id->{$id_name})->first();
            array_push($result, $row->name);
        }
        
        return $result;
    }
    
    private function fetch_value($model, $id, $name)
    {
        $result = $model::where('id', $id->{$name})->first();
        return $result->name;
    }
    
    public function index(Request $request)
    {
        if ($request->q) {
            $rows = College::where('name', 'LIKE', '%' . $request->q . '%')->orWhere('slug', 'LIKE', '%' . $request->q . '%')->get();
            
            foreach ($rows as $row)
            {
                $row->state = State::where('id', $row->state_id)->first()->name;
                $row->city = City::where('id', $row->city_id)->first()->name;
                
                unset($row->state_id);
                unset($row->city_id);
                
                // Multiple Values
                $row->college_type = $this->fetch_multiple_values(CollegeType::class, CollegeCollegeType::where('college_id', $row->id)->get(), 'college_type_id');
                $row->affiliated = $this->fetch_multiple_values(Affiliated::class, CollegeAffiliated::where('college_id', $row->id)->get(), 'affiliated_id');
                $row->streams = $this->fetch_multiple_values(Stream::class, CollegeStream::where('college_id', $row->id)->get(), 'stream_id');
                $row->program_types = $this->fetch_multiple_values(Program::class, CollegeProgramType::where('college_id', $row->id)->get(), 'program_type_id');
                $row->course_types = $this->fetch_multiple_values(CourseType::class, CollegeCourseType::where('college_id', $row->id)->get(), 'course_type_id');
                $row->entrance_exams = $this->fetch_multiple_values(EntranceExam::class, CollegeEntranceExam::where('college_id', $row->id)->get(), 'entrance_exam_id');
                $row->courses = $this->fetch_multiple_values(Course::class, CollegeCourse::where('college_id', $row->id)->get(), 'course_id');
            }
            
            return response()->json($rows);
        }
        
        $rows_per_page = 50;
        $page = $request->page ?? 0;
        
        if ($page >= 0) {
            $count = College::count();
            $rows = College::orderBy('id')->offset($page * 50)->limit($rows_per_page)->get();
            
            foreach ($rows as $row)
            {
                $row->state = State::where('id', $row->state_id)->first()->name;
                $row->city = City::where('id', $row->city_id)->first()->name;
                
                unset($row->state_id);
                unset($row->city_id);
                
                // Multiple Values
                $row->college_type = $this->fetch_multiple_values(CollegeType::class, CollegeCollegeType::where('college_id', $row->id)->get(), 'college_type_id');
                $row->affiliated = $this->fetch_multiple_values(Affiliated::class, CollegeAffiliated::where('college_id', $row->id)->get(), 'affiliated_id');
                $row->streams = $this->fetch_multiple_values(Stream::class, CollegeStream::where('college_id', $row->id)->get(), 'stream_id');
                $row->program_types = $this->fetch_multiple_values(Program::class, CollegeProgramType::where('college_id', $row->id)->get(), 'program_type_id');
                $row->course_types = $this->fetch_multiple_values(CourseType::class, CollegeCourseType::where('college_id', $row->id)->get(), 'course_type_id');
                $row->entrance_exams = $this->fetch_multiple_values(EntranceExam::class, CollegeEntranceExam::where('college_id', $row->id)->get(), 'entrance_exam_id');
                $row->courses = $this->fetch_multiple_values(Course::class, CollegeCourse::where('college_id', $row->id)->get(), 'course_id');
            }
            return response()->json([$rows, $count]);
        }
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'state' => 'required',
            'city' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        
        try {
        
            $college = College::create([
                'name' => $request->name,
                'title' => $request->title,
                'meta_description' => $request->meta_description ?? '',
                'slug' => $request->slug,
                'featuredImages' => json_encode($request->featuredImages) ?? '',
                'estd' => substr($request->estd, 0, 4) ?? '',
                'location' => $request->location ?? '',
                'website' => $request->website ?? '',
                'state_id' => $request->state,
                'city_id' => $request->city
            ]);
            
            $this->save_multiple_values(CollegeCollegeType::class, $request->college_type, 'college_type_id', $college->id);
            $this->save_multiple_values(CollegeStream::class, $request->streams, 'stream_id', $college->id);
            $this->save_multiple_values(CollegeAffiliated::class, $request->affiliated, 'affiliated_id', $college->id);
            $this->save_multiple_values(CollegeProgramType::class, $request->program_types, 'program_type_id', $college->id);
            $this->save_multiple_values(CollegeCourseType::class, $request->course_types, 'course_type_id', $college->id);
            $this->save_multiple_values(CollegeEntranceExam::class, $request->entrance_exams, 'entrance_exam_id', $college->id);
            $this->save_multiple_values(CollegeCourse::class, $request->courses, 'course_id', $college->id);
        } catch (Exception $e) {
            dd($e);
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function update(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach ($rowsToBeEffected as $row)
        {
            $college = College::find($row);
            
            if (!$college) {
                return response()->json(['message' => 'document does not exist']);
            }
            
            $this::check_and_save($request->name, $college, 'name');
            $this::check_and_save($request->title, $college, 'title');
            $this::check_and_save($request->meta_description, $college, 'meta_description');
            $this::check_and_save($request->info_page, $college, 'info_page');
            $this::check_and_save($request->slug, $college, 'slug');
            $this::check_and_save($request->featuredImages ? json_encode($request->featuredImages) : null, $college, 'featuredImages');
            $this::check_and_save(substr($request->estd, 0, 4), $college, 'estd');
            $this::check_and_save($request->location, $college, 'location');
            $this::check_and_save($request->website, $college, 'website');
            $this::check_and_save($request->state, $college, 'state_id');
            $this::check_and_save($request->city, $college, 'city_id');
            
            $this->save_multiple_values(CollegeCollegeType::class, $request->college_type, 'college_type_id', $college->id);
            $this->save_multiple_values(CollegeStream::class, $request->streams, 'stream_id', $college->id);
            $this->save_multiple_values(CollegeAffiliated::class, $request->affiliated, 'affiliated_id', $college->id);
            $this->save_multiple_values(CollegeProgramType::class, $request->program_types, 'program_type_id', $college->id);
            $this->save_multiple_values(CollegeCourseType::class, $request->course_types, 'course_type_id', $college->id);
            $this->save_multiple_values(CollegeEntranceExam::class, $request->entrance_exams, 'entrance_exam_id', $college->id);
            $this->save_multiple_values(CollegeCourse::class, $request->courses, 'course_id', $college->id);
            
            $college->save();
            
        }
        
        return response()->json(['message' => 'success']);
    }
    
    public function delete(Request $request)
    {
        $rowsToBeEffected = $request->rows;
        
        foreach($rowsToBeEffected as $row)
        {
            College::destroy($row);
        }
        
        return response()->json(['message' => 'success']);
    }
    
    protected function make_list($data)
    {
        $list = [];
        
        if ($data) {
            foreach ($data as $row)
            {
                array_push($list, [$row->name, $row->id]);
            }
            
            return $list;
        }
    }
    
    public function state_list() {
        return response()->json($this->make_list($this->list()['states']));
    }
    
    public function city_list()
    {
        return response()->json($this->make_list($this->list()['cities']));
    }
    
    public function college_type_list()
    {
        return response()->json($this->make_list($this->list()['college type']));
    }
    
    public function affiliated_list()
    {
        return response()->json($this->make_list($this->list()['affiliated']));
    }
    
    public function stream_list()
    {
        return response()->json($this->make_list($this->list()['stream']));
    }
    
    public function program_type_list()
    {
        return response()->json($this->make_list($this->list()['program']));
    }
    
    public function course_type_list()
    {
        return response()->json($this->make_list($this->list()['course type']));
    }
    
    public function entrance_exam_list()
    {
        return response()->json($this->make_list($this->list()['entrance exam']));
    }
    
    public function courses_list()
    {
        return response()->json($this->make_list($this->list()['courses']));
    }
    
    public function list()
    {
        $filter_list['city'] = City::all(['name', 'id']);;
        $filter_list['state'] = State::all(['name', 'id']);
        $filter_list['courses'] = Course::all(['name', 'id']);
        $filter_list['entrance'] = EntranceExam::all(['name', 'id']);
        $filter_list['affiliated'] = Affiliated::all(['name', 'id']);
        $filter_list['stream'] = Stream::all(['name', 'id']);
        
        return $filter_list;
    }
    
    public function display(Request $request, $slug = null)
    {
        $direction = 'asc';
        
        if ($request->direction) $direction = 'desc';
        
        if ($slug) {
            $filters = explode('&', $slug);
            $filters = array_filter($filters, function ($value) {
                if (str_contains($value, '=')) return $value;
            });

            // dd(Stream::with('colleges')->where('name', 'Management')->where('colleges.id', 2)->get());

            // dd(College::whereHas('stream', function ($q) {
            //     $q->where('name', 'Aviation');
            // })
            // ->whereHas('city', function ($q) {
            //     $q->where('name', 'Mumbai');
            // })
            // ->get());
            
            $colleges = College::applyFilters($filters, $request->page - 1, $direction);
            
        } else {
            
            $colleges = College::offset(($request->page ? $request->page - 1 : 0) * 10)->limit(10)->get();
            
            if ($slug > 1) {
                return view('pages.listing.list', ['colleges' => $colleges]);
            }
        }
        
        return view('pages.listing.listing', [
            'colleges' => $colleges,
            'author' => Author::get(),
            'filter_list' => $this->list(),
            'sort_direction' => $direction,
            'current_filters_url' => $slug ?? '',
            'current_filters_list' => $filters ?? [],
            'page' => $request->page ?? 1,
        ]);
        
    }
    
    public function applyFilter($params)
    {
        $filters = explode('/', $params);
        
        $filterdColleges = College::filterColleges($filters);
        
        return [$params, $filterdColleges];
    }
    
}
