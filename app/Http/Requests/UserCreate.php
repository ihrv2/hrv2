<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class UserCreate extends Request
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
            'icno' => 'required|unique:users',
            'email' => 'required'
        ];
    }




    public function messages()
    {
        return [
            'name.required' => 'Please insert Name.',
            'icno.required' => 'Please insert IC No.',
            'email.required' => 'Please insert Email Address.',
        ];
    } 









}
