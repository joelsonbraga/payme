<?php

namespace App\Http\Requests\Shopkeeper;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreContractServiceRequest
 * @package App\Http\Requests\ContractService
 */
class StoreShopkeeperRequest extends FormRequest
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
            'type' => [
                'required',
                Rule::in(['shopkeeper']),
            ],
            'type_document' => [
                'required',
                Rule::in(['cnpj']),
            ],
            'document' => [
                'required',
                'regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/',
                Rule::unique('persons'),
            ],
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('persons'),
            ],
            'cellphone' => [
                'required',
                Rule::unique('persons'),
            ],
            'user.password' => [
                'required',
            ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'type_document.required'  => __('The type document is required.'),
            'type.required'       => __('The type is required.'),
            'document.required'   => __('The document is required.'),
            'document.unique'     => __('There is already a shopkeeper with this document.'),
            'name.required'       => __('The name is required.'),
            'email.required'      => __('The email is required.'),
            'email.unique'        => __('There is already a shopkeeper with this email.'),
            'cellphone.required'  => __('The cellphone is required.'),
            'cellphone.unique'  => __('The cellphone has already been taken.'),
        ];
    }
}
