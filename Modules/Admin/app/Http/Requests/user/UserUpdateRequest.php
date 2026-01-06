<?php

namespace Modules\Admin\Http\Requests\user;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['sometimes','email','unique:users,email,' . $this->route('admin')->id],
            'username' => ['sometimes','nullable','string','max:255','unique:users,username,' . $this->route('admin')->id],
            'password' => ['sometimes','nullable','string','min:6'],

            'role_ids' => ['sometimes','array'],
            'role_ids.*' => ['integer','exists:roles,id'],

            'permission_ids' => ['sometimes','array'],
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
