<?php

namespace Modules\College\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCollegeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:255',
            'state_id'=>'required',
            'city_id'=>'required',
            'estd'=>'required',
            'location'=>'required',
            'contacts'=>'required',
            'website'=>'required',
            'logo'=>'nullable',
            'affiliateds'=>'required',
            'college_types'=>'required',
            'streams'=>'required',
            'program_types'=>'required',
            'course_types'=>'required',
            'entrance_exams'=>'required',
            'courses'=>'required',
            'info'=>'required'
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
