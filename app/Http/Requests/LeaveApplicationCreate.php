<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class LeaveApplicationCreate extends Request
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
            'date_to' => 'required|sometimes',
            'leave_file' => 'min:1|max:2000|mimes:jpeg,jpg,png,bmp,gif,svg'
        ];
    }


    public function messages()
    {
        return [
            'desc.required' => 'Please insert Description.',
            'date_from.required' => 'Please select Start Date.',
            'date_to.required' => 'Please select End Date.',
            'leave_file.min' => 'File attachment is too small.',
            'leave_file.max' => 'File attachment is too large. Please resize it.',
            'leave_file.mimes' => 'File attachment is not allowed.'
        ];
    } 


}
