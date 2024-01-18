<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Certifique-se de importar a classe User corretamente

class RegistrarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    public function criarUsuario(): User
    {
        return User::create([
            'name' => $this->validated()['name'],
            'email' => $this->validated()['email'],
            'password' => Hash::make($this->validated()['password']),
        ]);
    }
    
}
