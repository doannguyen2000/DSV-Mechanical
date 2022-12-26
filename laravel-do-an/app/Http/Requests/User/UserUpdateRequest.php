<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->route()->parameters("id");
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->whereNot('id', $id)
            ],
            'date_of_birth' => [
                'date',
                'required'
            ],
            'address' => [
                'required',
                'string'
            ],
            'fullname' => [
                'required',
                'string'
            ],
            'gender' => [
                'string',
                'required',
                Rule::in(['male', 'female', 'other'])
            ]
        ];
    }
}
