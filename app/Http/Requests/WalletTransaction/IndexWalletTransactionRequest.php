<?php

namespace App\Http\Requests\WalletTransaction;

use Illuminate\Foundation\Http\FormRequest;

class IndexWalletTransactionRequest extends FormRequest
{

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'origin' => [
				'required',
			],
			'destiny' => [
				'required',
			],
			'type' => [
				'required',
			],
			'status' => [
				'required',
			],
			'value' => [
				'required',
			],
		];
	}

	public function messages()
	{
		return [
			'origin.required' => __('A origin is required.'),
			'destiny.required' => __('A destiny is required.'),
			'type.required' => __('A type is required.'),
			'status.required' => __('A status is required.'),
			'value.required' => __('A value is required.'),
		];
	}

}

