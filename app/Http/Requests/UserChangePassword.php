<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserChangePassword extends Request
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
            'old_password' => 'required',
            'new_password' => 'required|different:old_password',
            'confirm_new_password' => 'required|same:new_password'
        ];
    }




    public function messages()
    {
        return [
            'old_password.required' => 'Please insert Current Password.',
            'new_password.required' => 'Please insert New Password.',
            'confirm_new_password.required' => 'Please re-enter New Password.',        
        ];
    } 



}


