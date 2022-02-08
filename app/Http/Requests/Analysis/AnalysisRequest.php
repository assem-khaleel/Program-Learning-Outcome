<?php

namespace App\Http\Requests\Analysis;

use Illuminate\Foundation\Http\FormRequest;

class AnalysisRequest extends FormRequest
{

    protected $rules = [
        'analysis' => 'required|string',
        'recommendations' => 'required|string',
        'actions' => 'required|string',

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
                $this->rules['analysis'] = 'required|string';
                $this->rules['recommendations'] = 'required|string';
                $this->rules['actions'] = "required|string";
                break;
            case 'PATCH':
            case 'PUT':
            $this->rules['analysis'] = 'required|string';
            $this->rules['recommendations'] = 'required|string';
            $this->rules['actions'] = "required|string";
                break;
            default:
                break;
        }
        return $this->rules;
    }
}
