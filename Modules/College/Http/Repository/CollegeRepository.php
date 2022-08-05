<?php

namespace Modules\College\Http\Repository;

use App\Helpers\Cache;
use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Modules\College\Entities\City;
use Modules\College\Http\Requests\CreateCollegeRequest;
use Illuminate\Support\Str;
use Modules\College\Entities\College;
use Modules\College\Entities\CollegeAffiliated;
use Modules\College\Entities\CollegeCollegeType;
use Modules\College\Entities\CollegeContact;
use Modules\College\Entities\CollegeCourse;
use Modules\College\Entities\CollegeCourseType;
use Modules\College\Entities\CollegeDetails;
use Modules\College\Entities\CollegeEntranceExam;
use Modules\College\Entities\CollegeImage;
use Modules\College\Entities\CollegeStream;
use Modules\College\Entities\CollegeSubpage;
use Modules\College\Entities\CollegeProgramType;
use Modules\College\Http\Controllers\CollegeController;
use Modules\College\Http\Controllers\ImageController;
use SystemConfig;

class CollegeRepository
{
    use RepositoryTrait;
    use ControllerTrait;

    public function addOrEdit(CreateCollegeRequest $request)
    {
        //  dd($request->file("logo"));
        try {
            // check if transaction is success or not.
            return DB::transaction(function () use ($request) {
                if($request->logo!=null){
                    $image = ImageController::uploadImage($request->file("logo"), SystemConfig::get("logo-thumbnail-width"), SystemConfig::get("logo-thumbnail-height"), "images/college/logo");
                }
               else{
                   $image='';
               }

                $data = $request->validated();
                $data['slug'] = Str::slug($data['name']);
                if ($image)
                    $data['logo'] = $image->id;
                $response = $this->createOrUpdate(new College(), $data);

                $data['college_id'] = $response['model']->id;



                $data['title'] = 'Info';
                $data['slug'] = 'info';
                $data['content'] = $data['info'];
                $data['created_by'] = auth()->user()->id;

                $this->createOrUpdate(new CollegeSubpage(), $data);
                // review subpage

                // comments
                // faq

                $reviewSubpage = [
                    'title' => "Review",
                    'slug' => 'review',
                    'created_by' => auth()->user()->id,
                    'college_id' => $response['model']->id,
                    'type' => 'review'
                ];

                $this->createOrUpdate(new CollegeSubpage(), $reviewSubpage);

                $this->addStreams($data['streams'], $response['model']->id);
                $this->addAffiliateds($data['affiliateds'], $response['model']->id);
                $this->addContacts($data['contacts'], $response['model']->id);
                $this->addCollegeTypes($data['college_types'], $response['model']->id);
                $this->addProgramTypes($data['program_types'], $response['model']->id);
                $this->addCourseTypes($data['course_types'], $response['model']->id);
                $this->addEntranceExams($data['entrance_exams'], $response['model']->id);
                $this->addCourses($data['courses'], $response['model']->id);


                // save or update to cache table
                self::dispatcher($response['model']->id);
                return redirect()->route('admin.college.list');
            });
        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }

    public function addEntranceExams(array $entranceExams, int $collegeId)
    {

        foreach ($entranceExams as $entrance) {
            CollegeEntranceExam::create([
                'college_id' => $collegeId,
                'entrance_exam_id' => $entrance
            ]);
        }
        return;
    }

    public function addCourses(array $courses, int $collegeId)
    {

        foreach ($courses as $course) {
            CollegeCourse::create([
                'college_id' => $collegeId,
                'course_id' => $course
            ]);
        }
        return;
    }

    public function addStreams(array $streams, int $collegeId)
    {

        foreach ($streams as $stream) {
            CollegeStream::create([
                'college_id' => $collegeId,
                'stream_id' => $stream
            ]);
        }
        return;
    }

    public function addAffiliateds(array $affiliateds, int $collegeId)
    {

        foreach ($affiliateds as $affiliated) {
            CollegeAffiliated::create([
                'college_id' => $collegeId,
                'affiliated_id' => $affiliated
            ]);
        }
        return;
    }

    public function addContacts(array $contacts, int $collegeId)
    {

        foreach ($contacts as $contact) {
            CollegeContact::create([
                'college_id' => $collegeId,
                'contact_number' => $contact
            ]);
        }
        return;
    }

    public function addCollegeTypes(array $college_types, int $collegeId)
    {

        foreach ($college_types as $types) {
            CollegeCollegeType::create([
                'college_id' => $collegeId,
                'college_type_id' => $types
            ]);
        }
        return;
    }

    public function addCourseTypes(array $course_types, int $collegeId)
    {

        foreach ($course_types as $type) {
            CollegeCourseType::create([
                'college_id' => $collegeId,
                'course_type_id' => $type
            ]);
        }
        return;
    }

    public function addProgramTypes(array $program_types, int $collegeId)
    {

        foreach ($program_types as $types) {
            CollegeProgramType::create([
                'college_id' => $collegeId,
                'program_type_id' => $types
            ]);
        }
        return;
    }

    public function addImage(Request $request)
    {
        $images = $request->file('image');

        if (is_array($images)) {
            foreach ($images as $key => $image) {
                //  dd($image);
                $i = ImageController::uploadImage($image, 460, 310, "images/college", $key == 0 ? true : false);
                $data['image_id'] = $i->id;
                $data['college_id'] = $request->college_id;
                $data['is_featured'] = $key == 0 ? true : false;
                $this->createOrUpdate(new CollegeImage(), $data);
            }
        }

        return redirect()->route('admin.college.image.list',['college'=> $request->college_id ]);
        return $this->jsonResponse('College Image', 201);
    }


    public static function dispatcher($id)
    {
        dispatch(function () use ($id) {
            $college = College::where('id', $id)->first();
            Cache::collegeObserver($college->slug);
        })->afterResponse();
    }


    public function edit(CreateCollegeRequest $request)
    {
        try {
            // dd($request->all());


            // check if transaction is success or not.
            return DB::transaction(function () use ($request) {
                $data = $request->all();
                // dd($data);
                $college = College::where('id', $data['id'])->first();
                // $collegeDetail = CollegeDetails::where('college_id', $data['id'])->first();
                $collegeSubPages = CollegeSubpage::where('college_id', $data['id'])->where('slug','info')->first();
                // dd($collegeSubPages);
                if($collegeSubPages){
                    $collegeSubPages->content= $data['info'];
                    $collegeSubPages->save();
                }

                else{
                    $data['title'] = 'Info';
                    $data['slug'] = 'info';
                    $data['content'] = $data['info'];
                    $data['created_by'] = auth()->user()->id;
                    $data['college_id'] = $data['id'];

                    $this->createOrUpdate(new CollegeSubpage(), $data);
                }



                if ($request->hasFile('logo')) {
                    $image = ImageController::uploadImage($request->file("logo"), SystemConfig::get("logo-thumbnail-width"), SystemConfig::get("logo-thumbnail-height"), "images/college/logo");
                    $college->logo = $image->id;
                }

                $college->name = $data['name'];
                $college->slug = Str::slug($data['name']);

                $college->estd = $data['estd'];
                $college->location = $data['location'];
                $college->website = $data['website'];
                $college->state_id = $data['state_id'];
                $college->city_id = $data['city_id'];

                // dd($college);
                $college->update();


                $streams = CollegeStream::where('college_id', $data['id'])->get();

                foreach ($streams as $stream) {
                    $stream->delete();
                }

                $contacts = CollegeContact::where('college_id', $data['id'])->get();

                foreach ($contacts as $contact) {
                    $contact->delete();
                }

                $affiliateds = CollegeAffiliated::where('college_id', $data['id'])->get();

                foreach ($affiliateds as $affiliated) {
                    $affiliated->delete();
                }

                $college_types = CollegeCollegeType::where('college_id', $data['id'])->get();

                foreach ($college_types as $collegeType) {
                    $collegeType->delete();
                }

                $program_types = CollegeProgramType::where('college_id', $data['id'])->get();

                foreach ($program_types as $program_type) {
                    $program_type->delete();
                }

                $course_types = CollegeCourse::where('college_id', $data['id'])->get();

                foreach ($course_types as $course_type) {
                    $course_type->delete();
                }

                $entrance_exams = CollegeEntranceExam::where('college_id', $data['id'])->get();

                foreach ($entrance_exams as $entrance_exam) {
                    $entrance_exam->delete();
                }

                $courses = CollegeCourse::where('college_id', $data['id'])->get();

                foreach ($courses as $course) {
                    $course->delete();
                }



                $this->addStreams($data['streams'],$college->id);
                $this->addAffiliateds($data['affiliateds'],$college->id);
                $this->addContacts($data['contacts'],$college->id);
                $this->addCollegeTypes($data['college_types'],$college->id);
                $this->addProgramTypes($data['program_types'],$college->id);
                $this->addCourseTypes($data['course_types'],$college->id);
                $this->addEntranceExams($data['entrance_exams'],$college->id);
                $this->addCourses($data['courses'],$college->id);



                // save or update to cache table
                // self::dispatcher($response['model']->id);
                return redirect()->route('admin.college.list');
            });
        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }
}
