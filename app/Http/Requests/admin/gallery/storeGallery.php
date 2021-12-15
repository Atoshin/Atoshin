<?php

namespace App\Http\Requests\admin\gallery;

use Illuminate\Foundation\Http\FormRequest;

class storeGallery extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'bio'=>'required|max:3000',
            'wallet_address'=>'required|unique:wallets|string|regex:/0x[a-fA-F0-9]{40}/',
            'website'=>'url|nullable',
            'twitter'=>'url|nullable',
            'facebook'=>'url|nullable',
            'instagram'=>'url|nullable',
            'linkedin'=>'url|nullable',
            'youtube'=>'url|nullable',

        ];
    }
}
