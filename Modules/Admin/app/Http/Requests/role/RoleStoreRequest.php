<?php

namespace Modules\Admin\Http\Requests\role;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            // optional: allow sending permissions on create
            'permissions' => ['sometimes','array'],
            'permissions.*' => ['string','max:255'],
        ];
    }
}
