<?php

namespace App\Http\Requests;

use App\Rules\UsuarioRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminUserRequest extends FormRequest
{
    protected $rule;

    public function __construct(UsuarioRule $rule) {
        $this->rule = $rule;
    }

    public function authorize(): bool
    {
        return $this->rule->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'cpf' => 'required|string|min:14|max:14',
            'telefone' => 'required|string',
            'tipo_usuario_id' => 'required|integer|in:2,3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser uma string.',
            'max' => 'O campo :attribute deve ter no máximo :max.',
            'email' => 'O campo :attribute não é válido',
            'unique' => 'O campo :attribute deve ser único.',
            'confirmed' => 'O campo :attribute não confere.',
            'same' => 'Os campos confirmação da senha e senha devem corresponder.',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres.',
            'in' => 'O campo :attribute deve ser Proprietário (2) ou Inquilino (3).',
            'letters' => 'O campo :attribute deve conter ao menos uma letra.',
            'mixedCase' => 'O campo :attribute deve conter ao menos uma letra maiúscula e uma letra minúscula.',
            'symbols' => 'O campo :attribute deve conter ao menos um simbolo.',
            'numbers' => 'O campo :attribute deve conter ao menos um número.'
        ];
    }
}