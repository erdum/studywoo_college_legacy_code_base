<?php

namespace Modules\College\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEntranceExamRequest extends FormRequest
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
            'name'=>'required|max:255',
            'slug'=>'required|max:255'
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
