<?php

namespace Modules\Admin\Http\Requests\role;

use Illuminate\Foundation\Http\FormRequest;

class RoleSyncPermissionsRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'permissions' => ['required','array'],
            'permissions.*' => ['string','max:255'],
        ];
    }
}
