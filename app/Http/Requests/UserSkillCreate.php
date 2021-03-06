<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class UserSkillCreate extends Request
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
            'name' => 'required',
            'level' => 'required',
        ];
    }




    public function messages()
    {
        return [
            'name.required' => 'Please insert Name.',
            'level.required' => 'Please select Skill Level.',
        ];
    } 
}
