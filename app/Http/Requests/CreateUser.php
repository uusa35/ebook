<?php namespace App\Http\Requests;

class CreateUser extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return $this->user()->can('authorizeAccess','user_create');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email' => 'required|unique:users',
			'password' => 'required|confirmed',
			'name' => 'required',
		];
	}

}
