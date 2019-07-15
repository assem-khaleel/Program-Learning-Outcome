<?php

namespace App\Http\Requests\Assignments;

use Illuminate\Foundation\Http\FormRequest;

class AssignmentRequest extends FormRequest
{


    protected $rules = [

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
                $this->rules['name_en'] = 'required|unique:assignments,name_en,0,id,course_id,' . $this->course_id;
                $this->rules['name_ar'] = 'required|unique:assignments,name_ar,0,id,course_id,' . $this->course_id;
                $this->rules['created_by'] =   'nullable|numeric';

                break;
            case 'PATCH':
            case 'PUT':
            $this->rules['name_en'] = "required|unique:assignments,name_en,$this->assignment,id,course_id," . $this->course_id;
            $this->rules['name_ar'] =  "required|unique:assignments,name_ar,$this->assignment,id,course_id," . $this->course_id;
            $this->rules['created_by'] =   'nullable|numeric';

            break;
            default:
                break;
        }
        return $this->rules;
    }
}