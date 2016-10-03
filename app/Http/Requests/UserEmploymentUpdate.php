<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class UserEmploymentUpdate extends Request
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
            'company' => 'required',
            'position' => 'required',
            'salary' => 'required',
        ];
    }




    public function messages()
    {
        return [
            'company.required' => 'Please insert Company.',
            'position.required' => 'Please insert Position.',
            'salary.required' => 'Please insert Salary.',
        ];
    } 
}
