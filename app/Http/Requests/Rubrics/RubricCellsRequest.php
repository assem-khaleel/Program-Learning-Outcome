<?php

namespace App\Http\Requests\Rubrics;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed indicators
 * @property mixed descriptions
 * @property mixed rubric_id
 * @property mixed score
 * @property mixed levels
 * @property mixed orderIndicator
 * @property mixed orderLevel
 * @property mixed descriptionRubric
 * @property mixed name
 * @property mixed levelIds
 * @property mixed indicatorIds
 * @property mixed descriptionIds
 * @property mixed description
 * @property mixed rubric
 */
class RubricCellsRequest extends FormRequest
{
    protected $rules = [
        'created_by' => 'numeric',
        'score.*' => 'required|numeric',
        'indicators.*' => 'required',
        'levels.*' => 'required',
        'orderLevel.*' => 'required|numeric|distinct',
        'orderIndicator.*' => 'required|numeric|distinct',
        'description.*.*' => 'required',

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

                $this->rules['rubric_id'] = 'required|numeric';

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
