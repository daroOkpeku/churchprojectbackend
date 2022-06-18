<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class contactrequest extends FormRequest
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
    //     'fullname'=>$request->fullname,
    //     'email'=>$request->email,
    //     'subject'=>$request->subject,
    //    'message'=>$request->message,
        return [
            'fullname'=>'required|regex:/^[a-zA-Z0-9 ]*$/',
            'email'=>'required|email',
            'subject'=>'required|regex:/^[a-zA-Z0-9 ]*$/',
            'message'=>'required|regex:/^[a-zA-Z0-9.,;:& ]*$/'
        ];
    }
}
