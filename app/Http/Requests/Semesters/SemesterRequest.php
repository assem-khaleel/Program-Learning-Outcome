<?php

namespace App\Http\Requests\Semesters;

use Illuminate\Foundation\Http\FormRequest;

class SemesterRequest extends FormRequest
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
                $this->rules['name_en'] = 'required|unique:semesters,name_en';
                $this->rules['name_ar'] = 'required|unique:semesters,name_ar';
                $this->rules['start_date'] = 'required|date';
                $this->rules['end_date'] = 'required|date|after_or_equal:start_date';
                break;
            case 'PATCH':
            case 'PUT':
                $this->rules['name_en'] = 'required|unique:semesters,name_en,' . $this->semester;
                $this->rules['name_ar'] = 'required|unique:semesters,name_ar,' . $this->semester;
                $this->rules['start_date'] = 'required|date';
                $this->rules['end_date'] = 'required|date|after_or_equal:start_date';
                break;
            default:
                break;
        }
        return $this->rules;
    }
}
