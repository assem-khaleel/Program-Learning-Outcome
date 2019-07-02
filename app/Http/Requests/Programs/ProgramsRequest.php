<?php

namespace App\Http\Requests\Programs;

use Illuminate\Foundation\Http\FormRequest;

class ProgramsRequest extends FormRequest
{
    protected $rules = [
        'department_id' => 'required|numeric',

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
                $this->rules['name_en'] = 'required|unique:programs,name_en,0,id,department_id,' . $this->department_id;
                $this->rules['name_ar'] = 'required|unique:programs,name_ar,0,id,department_id,' . $this->department_id;

                break;
            case 'PATCH':
            case 'PUT':
                $this->rules['name_en'] = "required|unique:programs,name_en,$this->program,id,department_id," . $this->department_id;
                $this->rules['name_ar'] =  "required|unique:programs,name_ar,$this->program,id,department_id," . $this->department_id;
                         break;
            default:
                break;
        }
        return $this->rules;
    }
}
