<?php

namespace App\Http\Requests\Common;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCommonRequest extends FormRequest
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
                Rule::unique('persons')->where(function ($query) {
                    $query->where('uuid', '<>', $this->uuid);
                }),
            ],
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('persons')->where(function ($query) {
                    $query->where('uuid', '<>', $this->uuid);
                }),
            ],
            'cellphone' => [
                'required',
                Rule::unique('persons')->where(function ($query) {
                    $query->where('uuid', '<>', $this->uuid);
                }),
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
            'cellphone.unique'    => __('The cellphone has already been taken.'),
        ];
    }
}
