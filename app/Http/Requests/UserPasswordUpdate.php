<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserPasswordUpdate extends Request
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
            'new_password' => 'required',
            'confirm_new_password' => 'required|same:new_password'
        ];
    }




    public function messages()
    {
        return [
            'new_password.required' => 'Please insert New Password.',
            'confirm_new_password.required' => 'Please re-enter New Password.',        
        ];
    } 



}


