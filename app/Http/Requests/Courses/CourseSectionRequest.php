<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;

class CourseSectionRequest extends FormRequest
{
    protected $rules = [
        'teacher_id' => 'required|numeric',
        'course_id' => 'required|numeric',
        'semester_id' => 'required|numeric',

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
                $this->rules['code'] = 'required|unique:course_sections,code';
                break;
            case 'PATCH':
            case 'PUT':
                $this->rules['code'] = 'required|unique:course_sections,code,' . $this->course_section;
                break;
            default:
                break;
        }
        return $this->rules;
    }
}
