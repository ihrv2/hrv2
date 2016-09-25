<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class LeaveCreate extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'desc' => 'required',
            'date_from' => 'required',
            'date_to' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'desc.required' => 'Please insert Description.',
            'date_from.required' => 'Please select Start Date.',
            'date_to.required' => 'Please select End Date.',
        ];
    } 


}
