<?php

namespace Modules\College\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCollegeCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'nullable',
            'college_id'=>'nullable',
            'course_id'=>'required',
            'duration'=>'nullable',
            'entrance_exam_id'=>'nullable',
            'course_type_id'=>'nullable',
            'price'=>'nullable',
            'description'=>'nullable'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
