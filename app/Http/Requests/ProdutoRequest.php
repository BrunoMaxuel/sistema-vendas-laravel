<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|max:100',
            'preco' => 'required',
            'preco_custo' => 'required',
            'lucro' => 'required',
            'estoque' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O campo nome não pode ter mais de 100 caracteres.',
            'preco.required' => 'O campo preço é obrigatório.',
            'preco_custo.required' => 'O campo preço de custo é obrigatório.',
            'lucro.required' => 'O campo lucro é obrigatório.',
            'estoque.required' => 'O campo estoque é obrigatório.',
        ];
    }
}
