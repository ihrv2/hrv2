<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class UserFamilyCreate extends Request
{
    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'name' => 'required',
            'relation' => 'required',
        ];
    }




    public function messages()
    {
        return [
            'name.required' => 'Please insert Name.',       
            'relation.required' => 'Please insert Relation.',        
        ];
    } 


}
