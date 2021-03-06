<?php

namespace App\Http\Requests\Rubrics;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed rows
 * @property mixed columns
 * @property mixed description
 * @property mixed name
 * @property mixed descriptionRubric
 * @property mixed rubric
 */
class RubricRequest extends FormRequest
{
    protected $rules = [
        'created_by' => 'numeric',

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
                $this->rules['name'] = 'required|unique:rubrics,name';
                $this->rules['description'] = 'required|unique:rubrics,description';

                break;
            case 'PATCH':
            case 'PUT':
                $this->rules['name'] = 'required|unique:rubrics,name,' . $this->rubric;
                $this->rules['description'] = 'required|unique:rubrics,description,' . $this->rubric;

                break;
            default:
                break;
        }
        return $this->rules;
    }
}
