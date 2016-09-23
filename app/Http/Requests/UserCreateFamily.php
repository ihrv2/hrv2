<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserCreateFamily extends Request
{
    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'name' => 'required',
            'age' => 'required',
            'occupation' => 'required',
            'school_office' => 'required',
            'relation' => 'required',
        ];
    }




    public function messages()
    {
        return [
            'name.required' => 'Please select Status Contract.',
            'age.required' => 'Please select Start Date.',        
            'occupation.required' => 'Please select End Date.',        
            'school_office.required' => 'Please insert Salary.',        
            'relation.required' => 'Please insert Salary.',        
        ];
    } 


}
