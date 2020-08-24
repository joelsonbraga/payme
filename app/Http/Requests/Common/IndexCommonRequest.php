<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreContractServiceRequest
 * @package App\Http\Requests\ContractService
 */
class IndexCommonRequest extends FormRequest
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
                Rule::in(['cpf']),
            ],
            'type' => [
                'required',
                Rule::in(['common']),
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
