<?php

namespace App\Http\Requests;

class CreatePreview extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->checkAccessForEachPermission('preview_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $total_pages = \Session::get('total_chapter_pages');
        $preview_start = \Session::get('preview_start');
        return [
            'author_id'     => 'required',
            'book_id'       => 'required',
            'usersList'     => 'required',
            'preview_start' => 'required|min:1,max:'.$total_pages,
            'preview_end'   => 'required|min:'.$preview_start.',max:'.$total_pages
        ];

    }
}
