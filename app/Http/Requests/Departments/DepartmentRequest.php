<?php

namespace App\Http\Requests\Departments;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_en' => 'required|unique:departments,name_en,0,id,college_id,' . $this->request->get('college_id'),
            'name_ar' => 'required|unique:departments,name_ar,0,id,college_id,' . $this->request->get('college_id'),
            'college_id' => 'required|numeric',

        ];
    }
}
