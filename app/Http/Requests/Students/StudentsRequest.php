<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;
/**
 * @property mixed student
 */

class StudentsRequest extends FormRequest
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
                $this->rules['name_en'] = 'required|unique:students,name_en';
                $this->rules['student_no'] = 'required|numeric|unique:students,student_no';
                $this->rules['program_id'] = 'required|numeric';


                break;
            case 'PATCH':
            case 'PUT':
                $this->rules['name_en'] = 'required|unique:students,name_en,' . $this->student;
                $this->rules['student_no'] = 'required||numeric|unique:students,student_no,' . $this->student;
                $this->rules['program_id'] = 'required|numeric';


            break;
            default:
                break;
        }
        return $this->rules;
    }
}
