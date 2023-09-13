<?php

namespace app\Http\Requests\DeliveryAddress;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveryAddress extends FormRequest
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
            'recipient_name' => 'required|string|max:255',
            'recipient_phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'order_id.required' => 'Veuillez sélectionner une commande.',
            'order_id.integer' => 'Veuillez sélectionner une commande valide.',
            'recipient_name.required' => 'Veuillez saisir le nom du destinataire.',
            'recipient_name.string' => 'Le nom du destinataire doit être une chaîne de caractères.',
            'recipient_name.max' => 'Le nom du destinataire ne doit pas dépasser 255 caractères.',
            'recipient_phone.required' => 'Veuillez saisir le numéro de téléphone du destinataire.',
            'recipient_phone.string' => 'Le numéro de téléphone du destinataire doit être une chaîne de caractères.',
            'recipient_phone.max' => 'Le numéro de téléphone du destinataire ne doit pas dépasser 255 caractères.',
            'address.required' => 'Veuillez saisir l\'adresse du destinataire.',
            'address.string' => 'L\'adresse du destinataire doit être une chaîne de caractères.',
            'address.max' => 'L\'adresse du destinataire ne doit pas dépasser 255 caractères.',
            'postal_code.required' => 'Veuillez saisir le code postal du destinataire.',
            'postal_code.string' => 'Le code postal du destinataire doit être une chaîne de caractères.',
            'postal_code.max' => 'Le code postal du destinataire ne doit pas dépasser 255 caractères.',
            'city.required' => 'Veuillez saisir la ville du destinataire.',
            'city.string' => 'La ville du destinataire doit être une chaîne de caractères.',
            'city.max' => 'La ville du destinataire ne doit pas dépasser 255 caractères.',
            'country.required' => 'Veuillez saisir le pays du destinataire.',
            'country.string' => 'Le pays du destinataire doit être une chaîne de caractères.',
            'country.max' => 'Le pays du destinataire ne doit pas dépasser 255 caractères.',
        ];
    }

}
