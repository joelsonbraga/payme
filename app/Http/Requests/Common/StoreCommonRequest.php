<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


/**
 * Class StoreuserRequest
 * @package App\Http\Requests\user
 */
class StoreCommonRequest extends FormRequest
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
                Rule::in(['common']),
            ],
            'type_document' => [
                'required',
                Rule::in(['cpf']),
            ],
            'document' => [
                'required',
                'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
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
            'type.required'       => __('The type is required.'),
            'document.required'   => __('The document is required.'),
            'document.unique'     => __('There is already a user with this document.'),
            'name.required'       => __('The name is required.'),
            'email.required'      => __('The email is required.'),
            'email.unique'        => __('There is already a user with this e-mail.'),
            'cellphone.required'  => __('The cellphone is required.'),
            'cellphone.unique'  => __('The cellphone has already been taken.'),
        ];
    }
}
