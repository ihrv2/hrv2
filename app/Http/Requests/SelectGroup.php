<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class SelectGroup extends Request
{
    public function authorize()
    {
        return true;
    }




    public function rules()
    {
        return [
            'group_id' => 'required',
        ];
    }




    public function messages()
    {
        return [
            'group_id.required' => 'Please select Group.',
        ];
    } 


}
