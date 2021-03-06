<?php

namespace App\Http\Requests;

class EditAd extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('authorizeAccess','ad_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ads' => 'required|image',
            'url' => 'required|url'
        ];
    }
}
