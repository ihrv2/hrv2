<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class UserEducationUpdate extends Request
{



    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_education' => 'required',
        ];
    }




    public function messages()
    {
        return [
            'name_education.required' => 'Please insert Institution.',
        ];
    } 
}
