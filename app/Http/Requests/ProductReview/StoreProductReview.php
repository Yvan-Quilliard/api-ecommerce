<?php

namespace app\Http\Requests\ProductReview;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductReview extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'product_id' => 'required|integer',
            'user_id' => 'required|integer',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ];
    }
}
