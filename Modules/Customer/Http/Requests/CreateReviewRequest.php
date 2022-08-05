<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReviewRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'college_id'=>'required',
            'faculty'=>'required',
            'placement'=>'required',
            'social_life'=>'required',
            'interview'=>'required',
            'course'=>'required',
            'internship'=>'required',
            'hostel'=>'required',
            'title'=>'required',
            'description'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please add review title.',
            'description.required' => 'Please add review description.',
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
