<?php

namespace Modules\College\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCollegeVideoRequest extends FormRequest
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
                'title'=>'required',
                'url'=>'required',
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
