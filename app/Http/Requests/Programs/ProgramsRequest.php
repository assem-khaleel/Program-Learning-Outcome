<?php

namespace App\Http\Requests\Programs;

use Illuminate\Foundation\Http\FormRequest;

class ProgramsRequest extends FormRequest
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
            'name_en' => 'required|unique:programs,name_en,0,id,department_id,' . $this->request->get('department_id'),
            'name_ar' => 'required|unique:programs,name_ar,0,id,department_id,' . $this->request->get('department_id'),
            'department_id' => 'required|numeric',
        ];
    }
}
