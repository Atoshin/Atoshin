<?php

namespace App\Http\Requests\admin\asset;

use Illuminate\Foundation\Http\FormRequest;

class storeAsset extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'title'=>'required|min:3',
                'price'=>'required',
                'bio'=>'required|max:1024',
                'ownership_percentage'=>'required|numeric',
                'commission_percentage'=>'required|numeric',
                'royalties_percentage'=>'required|numeric',
                'total_fractions'=>'required|numeric',
                'sold_fractions'=>'numeric',
                'end_date'=>'date',
                'start_date'=>'date',
                'creator_id'=>'required',
                'artist_id'=>'required',
                'category_id'=>'required',




        ];
    }
}
