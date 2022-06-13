<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Authrequest extends FormRequest
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
            'fullname'=>'required|regex:/^[a-zA-Z0-9 ]*$/',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|regex:/^[a-zA-Z0-9 ]*$/',
          //   'is_admin'=>'required|integer'
        ];
    }
}
