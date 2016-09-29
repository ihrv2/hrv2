<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class LeaveRepApplicationCreate extends Request
{
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
            'no_day' => 'required',
            'month' => 'required',
            'year' => 'required',
            'rep_file' => 'min:1|max:2000|mimes:jpeg,jpg,png,bmp,gif,svg' 
        ];
    }




    public function messages()
    {
        return [
            'no_day.required' => 'Please select No. of Days.',
            'month.required' => 'Please select Month.',
            'year.required' => 'Please select Year.'
        ];
    } 
}
