<?php

namespace App\Http\Requests\WalletTransaction;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWalletTransactionRequest extends FormRequest
{

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
            'document' => [
                'required',
                'regex:/(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)|(^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$)/',
                Rule::exists('persons'),
            ],
			'value' => [
				'required',
			],
		];
	}

	public function messages()
	{
		return [
			'document.required' => __('A document is required.'),
			'value.required' => __('A value is required.'),
		];
	}

}

