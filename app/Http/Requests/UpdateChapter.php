<?php

namespace App\Http\Requests;


class UpdateChapter extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('checkAssignedPermission','chapter_change');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'body' => 'required',
            'id' => 'required',
            'book_id' => 'required'
        ];
    }
}
