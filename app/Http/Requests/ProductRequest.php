<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'nome' => 'required|min:3|max:255|string',
            'descricao' => 'required|min:3|max:255|string',
            'preco' => 'required|numeric',
            'categoria' => 'required|min:3|max:255|string',
        ];
    }
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório',
            'nome.min' => 'No mínimo 3 caracteres.',
            'nome.max' => 'No máximo 255 caracteres',
            'descricao.required' => 'A descrição é obrigatória',
            'descricao.min' => 'No mínimo 3 caracteres.',
            'descricao.max' => 'No máximo 255 caracteres',
            'preco.required' => 'O preço é obrigatório',
            'preco.min' => 'No mínimo 3 caracteres.',
            'preco.max' => 'No máximo 255 caracteres',
            'categoria.required' => 'A categoria é obrigatória',
            'categoria.min' => 'No mínimo 3 caracteres.',
            'categoria.max' => 'No máximo 255 caracteres',
        ];
    }
}
