<?php

namespace App\Http\Requests;


class EditSlide extends Request
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
            'caption' => 'required|min:5',
            'url' => 'required|min:10|url'
        ];
    }
}
