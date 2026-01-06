<?php

namespace Modules\Admin\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required','email','unique:users,email'],
            'username' => ['nullable','string','max:255','unique:users,username'],
            'password' => ['nullable','string','min:6'],

            'role_ids' => ['nullable','array'],
            'role_ids.*' => ['integer','exists:roles,id'],

            'permission_ids' => ['nullable','array'],
            'permission_ids.*' => ['integer','exists:permissions,id'],
        ];
    }


    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);
        unset($data['is_admin'], $data['blocked']);
        return $data;
    }
}
