<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCategory extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(\Cache::get('Module.Admin')) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => 'required|min:3|max:255',
            'name_en' => 'required|min:3|max:255',
        ];
    }
}
