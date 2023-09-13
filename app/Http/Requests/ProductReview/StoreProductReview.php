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

    public function messages()
    {
        return [
            'product_id.required' => 'Veuillez indiquer l\'identifiant du produit.',
            'product_id.integer' => 'L\'identifiant du produit doit être un nombre entier.',
            'user_id.required' => 'Veuillez indiquer l\'identifiant de l\'utilisateur.',
            'user_id.integer' => 'L\'identifiant de l\'utilisateur doit être un nombre entier.',
            'comment.required' => 'Veuillez saisir un commentaire.',
            'comment.string' => 'Le commentaire doit être une chaîne de caractères.',
            'rating.required' => 'Veuillez indiquer une note pour le produit.',
            'rating.integer' => 'La note doit être un nombre entier.',
            'rating.min' => 'La note doit être d\'au moins une étoile.',
            'rating.max' => 'La note ne peut pas dépasser 5 étoile.',
        ];
    }

}
