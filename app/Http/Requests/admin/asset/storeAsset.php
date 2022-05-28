<?php

namespace App\Http\Requests\admin\asset;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\Nullable;

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
//                'commission_percentage'=>'required|numeric',
                'royalties_percentage'=>'required|numeric',
                'total_fractions'=>'required|numeric',
//                'sold_fractions'=>'numeric',
                'end_date'=>'date|nullable|after_or_equal:start_date',
                'start_date'=>'date|nullable',
                'creator_id'=>'required',
                'artist_id'=>'required',
                'category_id'=>'required',
            'creation'=>'nullable',
            'order'=>'regex:/([0-4]{1})$/|unique:assets|nullable'




        ];
    }
}
