<?php

namespace App\Http\Requests\WalletTransaction;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexWalletTransactionRequest extends FormRequest
{

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'payee' => [
				'nullable',
			],
			'type' => [
				'nullable',
                Rule::in(['credit', 'debit']),
			],
		];
	}
}

