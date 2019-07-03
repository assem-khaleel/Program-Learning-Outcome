<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
                $this->rules['name_en'] = 'required|unique:courses,name_en';
                $this->rules['name_ar'] = 'required|unique:courses,name_ar';
                break;
            case 'PATCH':
            case 'PUT':
                $this->rules['name_en'] = 'required|unique:courses,name_en,' . $this->course;
                $this->rules['name_ar'] = 'required|unique:courses,name_ar,' . $this->course;
                break;
            default:
                break;
        }
        return $this->rules;
    }
}
