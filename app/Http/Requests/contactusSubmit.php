<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class contactusSubmit extends Request
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
    public function rules()
    {
        return [
            'name'    => 'required|max:255',
            'email'   => 'required|email',
            'subject' => 'required|min:3',
            'content' => 'required|max:1000'
        ];
    }
}
