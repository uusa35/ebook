<?php

namespace App\Http\Requests;

class CreateMessage extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('authorizeAccess','message_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => 'required|min:5',
            'subject' => 'required|min:5',
            'title' => 'required'
        ];
    }
}
