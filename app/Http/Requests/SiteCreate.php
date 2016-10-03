<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class SiteCreate extends Request
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

    public function rules()
    {
        return [
            'code' => 'required|unique:sites',
            'address' => 'required',
            'email' => 'required',
        ];
    }




    public function messages()
    {
        return [
            'code.required' => 'Please insert Code.',        
            'address.required' => 'Please insert Address.',        
            'email.required' => 'Please insert Email.',        
        ];
    } 

}
