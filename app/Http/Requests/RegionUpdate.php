<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegionUpdate extends Request
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // public function rules()
    // {
    //     return [
    //         //
    //     ];
    // }


    public function rules()
    {
        return [
            'name' => 'required',
            'name_eng' => 'required',
            'report_to' => 'required'
        ];
    }




    public function messages()
    {
        return [
            'name.required' => 'Please insert Name in Malay.',
            'name_eng.required' => 'Please insert Name in English.',
            'report_to.required' => 'Please select Manager.',
        ];
    } 



}
