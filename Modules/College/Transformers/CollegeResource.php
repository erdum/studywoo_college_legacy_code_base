<?php

namespace Modules\College\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CollegeResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $collegeDetail = $this->collegeDetail;
        $info = $this->subPage("info");
        // dd($info->author->adminDetail);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->featuredImage(false),
            'sub_pages' => $this->getSubPages(),
            'info_page'=>[
                'author'=>[
                    'username'=>$info->author->username,
                    'email'=>$info->author->email,
                    'full_name'=>$info->author->adminDetail->full_name,
                    'avatar'=>$info->author->adminDetail->avatar,
                    'facebook'=>$info->author->adminDetail->facebook,
                    'twitter'=>$info->author->adminDetail->twitter,
                    'instagram'=>$info->author->adminDetail->instagram,
                    'linkedin'=>$info->author->adminDetail->linkedin,
                    'skype'=>$info->author->adminDetail->skype,
                    'github'=>$info->author->adminDetail->github,
                ],
                'pageData'=>$info
            ],
            'college_detail' => [
                'logo' => $collegeDetail->logo,
                'estd' => $collegeDetail->estd,
                // 'affiliated' => $collegeDetail->affiliated->name,
                'state' => [
                    'name' => $collegeDetail->state->name,
                    'slug' => $collegeDetail->state->slug
                ],
                'city' => [
                    'name' => $collegeDetail->city->name,
                    'slug' => $collegeDetail->city->slug
                ],
                "college_type" => [
                    'name' => $collegeDetail->type->name,
                    'slug' => $collegeDetail->type->slug
                ]
            ],
            'courses' =>  CollegeCoursesResource::collection($this->courses)

        ];
        // return parent::toArray($request);
    }
}
