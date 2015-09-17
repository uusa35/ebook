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

        return $this->checkAccessForEachPermission('book_create');

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'title_en'    => 'min:5',
            //'title_ar'    => 'min:5',
            'title' => 'min:5|required|max:500',
            //'price'       => 'numeric|max:500',
            'cover' => 'image|required',
            'description' => 'required|min:5',
            //'cover_ar'    => 'min:5',
            //'cover_en'    => 'min:5',
            //'type'        => 'required'
        ];
    }
}
