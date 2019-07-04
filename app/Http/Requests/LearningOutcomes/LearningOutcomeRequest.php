<?php

namespace App\Http\Requests\LearningOutcomes;

use Illuminate\Foundation\Http\FormRequest;

class LearningOutcomeRequest extends FormRequest
{
    protected $rules = [
        'program_id' => 'required|numeric',

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
                $this->rules['name_en'] = 'required|unique:learning_outcomes,name_en';
                $this->rules['name_ar'] = 'required|unique:learning_outcomes,name_ar';
                $this->rules['description_en'] = 'required|unique:learning_outcomes,description_en';
                $this->rules['description_ar'] = 'required|unique:learning_outcomes,description_ar';

                break;
            case 'PATCH':
            case 'PUT':
                $this->rules['name_en'] = 'required|unique:learning_outcomes,name_en,' . $this->learning_outcome;
                $this->rules['name_ar'] = 'required|unique:learning_outcomes,name_ar,' . $this->learning_outcome;
                $this->rules['description_en'] = 'required|unique:learning_outcomes,description_en,' . $this->learning_outcome;
                $this->rules['description_ar'] = 'required|unique:learning_outcomes,description_ar,' . $this->learning_outcome;

            break;
            default:
                break;
        }
        return $this->rules;
    }
}
