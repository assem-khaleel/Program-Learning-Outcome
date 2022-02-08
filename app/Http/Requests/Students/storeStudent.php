<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class storeStudent extends FormRequest
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

//                if($courseSection===0){
//                    $this->rules['student_id'] = 'required';
//                    $this->rules['course_section_id'] = 'required';
//                }else {
//                    $this->rules['student_id'] = 'required|unique:course_section_student,student_id,NULL,NULL,course_section_id,' . $this->courseSection;
//                    $this->rules['course_section_id'] = 'required|unique:course_section_student,course_section_id,NULL,NULL,student_id,' .$this->courseSection;
//                }
                break;
            case 'PATCH':
            case 'PUT':
                break;
            default:
                break;
        }
        return $this->rules;
    }
}
