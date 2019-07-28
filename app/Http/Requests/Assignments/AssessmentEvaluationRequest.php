<?php

namespace App\Http\Requests\Assignments;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed cells
 * @property mixed studentId
 * @property mixed assessmentId
 */
class AssessmentEvaluationRequest extends FormRequest
{
    protected $rules = [
        'cells.*' => 'required|numeric',

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
