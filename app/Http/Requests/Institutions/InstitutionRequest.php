<?php

namespace App\Http\Requests\Institutions;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionRequest extends FormRequest
{
    protected $rules = [
        'description_en' => 'required',
        'description_ar' => 'required',
        'vision_en' => 'required',
        'vision_ar' => 'required',
        'mission_en' => 'required',
        'mission_ar' => 'required',
        'location' => 'required',
    ];

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

        $method = $this->method();
        if($this->get('_method', null) !== null)
        {
            $method = $this->get('_method');
        }
        $this->offsetUnset("_method");

        switch ($method) {
            case 'GET':
            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                $this->rules['name_en'] = 'required|unique:institutions,name_en';
                $this->rules['name_ar'] = 'required|unique:institutions,name_ar';

                break;
            case 'PATCH':
            case 'PUT':
                $this->rules['name_en'] = "required|unique:institutions,name_en,$this->institution,id";
                $this->rules['name_ar'] = "required|unique:institutions,name_ar,$this->institution,id";
                break;
            default:
                break;
        }
        return $this->rules;
    }
}
