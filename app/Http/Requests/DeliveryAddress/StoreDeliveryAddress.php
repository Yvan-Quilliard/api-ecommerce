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
            'required' => 'Le champ :attribute est obligatoire.',
            'integer' => 'Le champ :attribute doit être un nombre entier.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'max' => 'La longueur maximale du champ :attribute est de :max caractères.',
        ];
    }

}
