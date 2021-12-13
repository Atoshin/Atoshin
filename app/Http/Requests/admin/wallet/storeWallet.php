<?php

namespace App\Http\Requests\admin\wallet;

use Illuminate\Foundation\Http\FormRequest;

class storeWallet extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'wallet_address'=>'required|string|regex:/0x[a-fA-F0-9]{40}/g'
        ];
    }
}
