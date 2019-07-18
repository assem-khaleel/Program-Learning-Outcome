<?php

namespace App\Http\Requests\Departments;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    protected $rules = [
        'college_id' => 'required|numeric',
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
                $this->rules['name_en'] = 'required|unique:departments,name_en,0,id,college_id,' . $this->college_id;
                $this->rules['name_ar'] = 'required|unique:departments,name_ar,0,id,college_id,' . $this->college_id;
                break;
            case 'PATCH':
            case 'PUT':
                $this->rules['name_en'] = "required|unique:departments,name_en,$this->department,id,college_id," . $this->college_id;
                $this->rules['name_ar'] = "required|unique:departments,name_ar,$this->department,id,college_id," . $this->college_id;
                break;
            default:
                break;
        }
        return $this->rules;
    }
}
