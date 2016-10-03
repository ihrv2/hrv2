<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class UserLanguageCreate extends Request
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
            'dialect' => 'required',
            'written' => 'required',
            'reading' => 'required',
            'spoken' => 'required',
        ];
    }




    public function messages()
    {
        return [
            'dialect.required' => 'Please insert Dialect.',
            'written.required' => 'Please select Written.',
            'reading.required' => 'Please select Reading.',
            'spoken.required' => 'Please select Spoken.',
        ];
    } 
}
