<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
                'required',
            ],
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->uuid, 'uuid'),
            ],
            'password' => [
                'required',
            ],
            'email_verified_at' => [
                'nullable',
            ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'person_id.required' => __('The person is required.'),
            'email.required'     => __('The e-mail is required.'),
            'email.unique'       => __('There is already a user with this e-mail.'),
            'name.required'      => __('The name is required.'),
            'password.required'  => __('The password is required.'),
        ];
    }
}
