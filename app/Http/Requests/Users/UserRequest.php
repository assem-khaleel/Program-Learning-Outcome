<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    protected $rules = [
        'name' => 'required|string|max:255',
        'image' => 'mimes:jpeg,jpg,bmp,png|max:10000',
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
                $this->rules['email'] = 'required|string|email|max:255|unique:users';
                break;
            case 'PATCH':
            case 'PUT':
                $this->rules['email'] = 'required|string|email|max:255|unique:users,email,' . $this->user;
                break;
            default:
                break;
        }
        return $this->rules;
    }
}
