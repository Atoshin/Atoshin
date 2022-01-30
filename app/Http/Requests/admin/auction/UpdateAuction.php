<?php

namespace App\Http\Requests\admin\auction;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuction extends FormRequest
{
//    /**
//     * Determine if the user is authorized to make this request.
//     *
//     * @return bool
//     */
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
            'asset_name'=>'required',
            'auction_name'=>'required',
            'size'=>'required',
            'material'=>'required',
            'creation_date'=>'required',
            'auction_date'=>'required|date',
            'sold_price'=>'required|numeric',
            'estimated_price'=>'required|numeric',
            'hammer_price'=>'required|numeric',
        ];
    }
}
