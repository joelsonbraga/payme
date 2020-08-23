<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreContractServiceRequest
 * @package App\Http\Requests\ContractService
 */
class IndexUserRequest extends FormRequest
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
