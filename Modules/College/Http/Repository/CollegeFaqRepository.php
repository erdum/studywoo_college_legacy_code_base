<?php

namespace Modules\College\Http\Repository;

use App\Traits\ControllerTrait;
use App\Traits\RepositoryTrait;
use CreateCollegeFaqsTable;
use Illuminate\Support\Facades\DB;
use Modules\College\Entities\City;
use Modules\College\Entities\CollegeFaq;
use Modules\College\Entities\Faq;
use Modules\College\Http\Requests\CreateCityRequest;
use Modules\College\Http\Requests\CreateCollegeFaqRequest;

class CollegeFaqRepository
{
    use RepositoryTrait;
    use ControllerTrait;

    public function addOrEdit(CreateCollegeFaqRequest $request)
    {
      // dd($request->all());
        try {


            // check if transaction is success or not.
            return DB::transaction(function () use ($request) {
                $data = $request->validated();
                for($i=0; $i< count($data['question']); $i++){

                    if($data['question'][$i]!=null && $data['answer'][$i]!=null)
                    {
                        $response=$this->createOrUpdate(new Faq(), ['question'=>$data['question'][$i], 'answer'=>$data['answer'][$i]]);
                        $faq=[];
                        $faq['faq_id'] = $response['model']->id;
                        $faq['college_id']=$data['college_id'];
                       // CollegeRepository::dispatcher($data['college_id']);
                        $this->createOrUpdate(new CollegeFaq(), $faq);
                    }
                }
                //$response = $this->createOrUpdate(new Faq(), $data);
                // $data['faq_id'] = $response['model']->id;
                // CollegeRepository::dispatcher($data['college_id']);
                // $this->createOrUpdate(new CollegeFaq(), $data);
                //return redirect()->route('admin.college.faq.list',['college'=>$data['college_id']]);
                return $this->jsonResponse('FAQ',201);
            });
        } catch (\Throwable $th) {
            // return $this->jsonResponse('Error while creating category.',400);
            throw $th;
        }
    }
}
