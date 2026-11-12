<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMoneyRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true; //Auth::check(); // This checks if the user is authenticated
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			// 'name' => 'required|string|max:255',
			// 'year' => 'required|integer', // or 'date_format:Y' if you are storing just the year as a date
			// 'country' => 'required|string|max:255',
			// 'condition' => 'required|string|max:255',
			// 'price' => 'required|numeric|min:0', // assuming price is a positive value
			// 'observation' => 'nullable|string',
			// 'type' => 'required|string|max:255',
			// 'material' => 'required|string|max:255',
			// 'available_sell' => 'required|boolean',
			// 'user_id' => 'required|exists:users,id', // ensuring user_id exists in the users table
			// 'url_img' => 'required|string|max:255', // you might want to add rules for URLs
		];
	}
}
