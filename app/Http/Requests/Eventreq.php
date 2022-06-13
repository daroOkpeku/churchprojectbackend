<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Eventreq extends FormRequest
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
            'titleevent'=>'required|regex:/^[a-zA-Z0-9 ]*$/',
            'imgone'=>'required|image',
            'imgtwo'=>'required|image',
            'eventdetailone'=>'required|regex:/^[a-zA-Z0-9 ]*$/',
            'eventdetailtwo'=>'required|regex:/^[a-zA-Z0-9 ]*$/'
        ];
    }
}
