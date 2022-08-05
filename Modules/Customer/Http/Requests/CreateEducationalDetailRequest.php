<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEducationalDetailRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'tenth_passing_year'=>'required',
        'tenth_grading_system'=>'required',
        'tenth_marks'=>'required',
        'twelve_passing_year'=>'required',
        'twelve_grading_system'=>'required',
        'twelve_marks'=>'required',
        'grad_passing_year'=>'required',
        'grad_grading_system'=>'required',
        'grad_marks'=>'required',
        'detail'=>'required'
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
