<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransacaoRequest extends FormRequest
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
            'id_transacao' => 'required',
            'valor_parcela' => 'required',
            'venda_desconto' => 'required',
            'cliente' => 'required|min:4',
            'pagamento' => 'required'
        ];
    }
}
