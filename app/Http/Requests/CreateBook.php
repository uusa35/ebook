<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Session;

class CreateBook extends Request
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
            'title_en'    => 'min:5',
            'title_ar'    => 'min:5',
            'body'        => 'min:20',
            'price'       => 'numeric|max:500',
            'cover_ar'    => 'min:5',
            'cover_en'    => 'min:5',
            'type'        => 'required'
        ];
    }
}
