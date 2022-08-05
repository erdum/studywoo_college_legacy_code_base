<?php

namespace Modules\College\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CollegeListItem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'image' => $this->featuredImage(),
            'location' => [
                'state' => [
                    'name' => $this->collegeDetail->state->name,
                    'slug' => $this->collegeDetail->state->slug
                ],
                'city' => [
                    'name' => $this->collegeDetail->city->name,
                    'slug' => $this->collegeDetail->city->slug
                ]
            ]
        ];
        return parent::toArray($request);
    }
}
