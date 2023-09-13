<?php

namespace app\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer',
            'category_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Veuillez saisir le nom du produit.',
            'name.string' => 'Le nom du produit doit être une chaîne de caractères.',
            'name.max' => 'Le nom du produit ne doit pas dépasser 255 caractères.',
            'description.required' => 'Veuillez saisir la description du produit.',
            'description.string' => 'La description du produit doit être une chaîne de caractères.',
            'price.required' => 'Veuillez indiquer le prix du produit.',
            'price.numeric' => 'Le prix du produit doit être un nombre.',
            'price.min' => 'Le prix du produit doit être d\'au moins 0.01 €.',
            'stock.required' => 'Veuillez indiquer le stock disponible du produit.',
            'stock.integer' => 'Le stock du produit doit être un nombre entier.',
            'category_id.required' => 'Veuillez sélectionner la catégorie du produit.',
            'category_id.integer' => 'L\'identifiant de la catégorie du produit doit être un nombre entier.',
        ];
    }

}
