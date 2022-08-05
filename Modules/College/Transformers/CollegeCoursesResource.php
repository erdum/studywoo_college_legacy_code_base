<?php

namespace Modules\College\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CollegeCoursesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $entrance = $this->entranceExam;
        return [
            'name' => $this->course->name,
            'slug' => $this->course->slug,
            'duration' => $this->duration,
            'type' => [
                'name' => $this->type->name,
                'slug' => $this->type->slug
            ],
            'entrance' => [
                'name' => $entrance->name,
                'slug' => $entrance->slug
            ]
        ];
    }
}
