<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class UserJobUpdate extends Request
{
    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        return [
            'status_contract_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'salary' => 'required',
        ];
    }




    public function messages()
    {
        return [
            'status_contract_id.required' => 'Please select Status Contract.',
            'date_from.required' => 'Please select Start Date.',        
            'date_to.required' => 'Please select End Date.',        
            'salary.required' => 'Please insert Salary.',        
        ];
    } 


}
