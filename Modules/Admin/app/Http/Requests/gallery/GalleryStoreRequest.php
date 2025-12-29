<?php

namespace Modules\Admin\Http\Requests\gallery;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class GalleryStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */

    public function rules(): array
    {

        return [
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['sometimes', 'nullable', 'string'],
            'summary' => ['sometimes', 'nullable', 'string'],
            'avatar' => ['sometimes', 'nullable', 'string', 'max:255'],

            'website' => ['sometimes', 'nullable', 'string', 'max:255'],
            'youtube' => ['sometimes', 'nullable', 'string', 'max:255'],
            'instagram' => ['sometimes', 'nullable', 'string', 'max:255'],
            'twitter' => ['sometimes', 'nullable', 'string', 'max:255'],
            'facebook' => ['sometimes', 'nullable', 'string', 'max:255'],
            'linkedin' => ['sometimes', 'nullable', 'string', 'max:255'],

            'status' => ['sometimes', 'nullable', Rule::in(['published', 'unpublished'])],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
