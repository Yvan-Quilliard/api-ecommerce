<?php

namespace app\Http\Requests\OrderLine;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderLine extends FormRequest
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
            'order_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0.01',
        ];
    }

    public function messages()
    {
        return [
            'order_id.required' => 'Veuillez indiquer l\'identifiant de la commande.',
            'order_id.integer' => 'L\'identifiant de la commande doit être un nombre entier.',
            'product_id.required' => 'Veuillez indiquer l\'identifiant du produit.',
            'product_id.integer' => 'L\'identifiant du produit doit être un nombre entier.',
            'quantity.required' => 'Veuillez indiquer la quantité.',
            'quantity.integer' => 'La quantité doit être un nombre entier.',
            'quantity.min' => 'La quantité doit être d\'au moins 1.',
            'unit_price.required' => 'Veuillez indiquer le prix unitaire.',
            'unit_price.numeric' => 'Le prix unitaire doit être un nombre.',
            'unit_price.min' => 'Le prix unitaire doit être d\'au moins 0.01 €.',
        ];
    }
}
