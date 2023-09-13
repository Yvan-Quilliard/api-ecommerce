<?php

namespace app\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategory extends FormRequest
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
            'name'=>'required|max:255',
            'description'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le champ du nom de la catégorie est obligatoire.',
            'name.max' => 'Le nom de la catégorie ne doit pas dépasser 255 caractères.',
            'description.required' => 'Le champ description de la catégorie est obligatoire.'
        ];
    }
}
