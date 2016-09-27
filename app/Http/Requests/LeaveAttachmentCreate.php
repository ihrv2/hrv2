<?php

namespace IhrV2\Http\Requests;

use IhrV2\Http\Requests\Request;

class LeaveAttachmentCreate extends Request
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



    public function rules()
    {

    }




    public function messages()
    {

    } 


}
