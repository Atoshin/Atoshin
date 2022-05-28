<?php

namespace App\Http\Requests\api\wallet;

use Illuminate\Foundation\Http\FormRequest;

class storeWallet extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize()
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'walletAddress' => 'required|string|regex:/0x[a-fA-F0-9]{40}/'
        ];
    }
}
