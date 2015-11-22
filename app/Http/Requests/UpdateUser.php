<?php namespace App\Http\Requests;


class UpdateUser extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return $this->user()->can('checkAssignedPermission','user_change');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required',
			'phone' => 'numeric|min:5',
			'avatar' => 'image'
		];
	}

}
