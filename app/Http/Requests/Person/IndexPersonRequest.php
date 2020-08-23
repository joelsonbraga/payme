<?php

namespace App\Http\Requests\Person;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class IndexPersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'person_id' => [
                'nullable',
            ],
            'city_id' => [
                'nullable',
            ],
            'contract_service_id' => [
                'nullable',
            ],
            'type_document' => [
                'nullable',
                Rule::in(['cpf', 'cnpj', 'cnh', 'rg', 'other']),
            ],
            'type' => [
                'nullable',
                Rule::in([
                    'master',
                    'admin',
                    'shopper',
                    'customer',
                    'conductor',
                    'supermarket_chain',
                    'supermarket',
                    'collaborator',
                    'partner',
                ]),
            ],
            'document' => [
                'nullable',
            ],
            'name' => [
                'nullable',
            ],
            'email' => [
                'nullable',
                'email',
            ],
        ];
    }



}
