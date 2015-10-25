<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateBook extends Request
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
            //'title_en'    => 'required|min:5',
            //'title_ar'    => 'required|min:5',
            'title' => 'required|min:5',
            //'price'       => 'numeric|max:500',
            'cover'        => 'mimes:jpeg,bmp,png',
            'description' => 'required|min:5'
        ];
    }
}
