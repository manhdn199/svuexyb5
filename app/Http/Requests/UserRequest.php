<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
{
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
        return [
            'name' => 'required|max:255',
            'gender' => 'required',
            'email'=>'email|required|unique:users',
            'password' => 'bail|required|min:8',
            'password_confirmation' => 'bail|required|same:password',
            'birthday' =>'required|date|date_format:Y/m/d|before:'.now()->subYears(18)->toDateString(),
        ];
    }
    public function messages()
    {
        return [
            'name.required' => ' Required name',
            'email.email' => 'Error email!',
            'email.required' => 'Required email',
            'email' => 'Exists Email',
            'password.required' => 'Required password',
            'gender.required' => 'Required gender',
            'password.confirmed' => ' confirmed ',
            'birthday.before' => 'underage'
        ];
    }

}


