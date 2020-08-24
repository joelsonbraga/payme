<?php

namespace App\Http\Requests\Shopkeeper;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreContractServiceRequest
 * @package App\Http\Requests\ContractService
 */
class IndexShopkeeperRequest extends FormRequest
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
            'type_document' => [
                'nullable',
                Rule::in(['cnpj']),
            ],
            'type' => [
                'required',
                Rule::in(['shopkeeper']),
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
