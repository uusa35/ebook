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
        return $this->checkAccessForEachPermission('ad_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ads' => 'required|image'
        ];
    }
}
