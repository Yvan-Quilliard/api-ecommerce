<?php

namespace app\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
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
            'user_id.required' => 'Veuillez indiquer l\'identifiant de l\'utilisateur.',
            'user_id.integer' => 'L\'identifiant de l\'utilisateur doit être un nombre entier.',
            'order_date.required' => 'Veuillez indiquer la date de la commande.',
            'order_date.date' => 'La date de la commande doit être une date valide.',
            'status.required' => 'Veuillez saisir le statut de la commande.',
            'status.string' => 'Le statut de la commande doit être une chaîne de caractères.',
            'status.max' => 'Le statut de la commande ne doit pas dépasser 255 caractères.',
        ];
    }
}
