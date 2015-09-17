<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateChapter extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return $this->checkAccessForEachPermission('chapter_create');

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'min:5|required|max:500',
            'book_id' => 'required',
            'body' => 'required|min:10',
        ];
    }
}
