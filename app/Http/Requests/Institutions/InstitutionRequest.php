<?php

namespace App\Http\Requests\Institutions;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionRequest extends FormRequest
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
            'name_en' => 'required|unique:institutions,name_en',
            'name_ar' => 'required|unique:institutions,name_ar',
            'description_en' => 'required',
            'description_ar' => 'required',
            'vision_en' => 'required',
            'vision_ar' => 'required',
            'mission_en' => 'required',
            'mission_ar' => 'required',
            'location' => 'required',

        ];
    }
}
