<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user= $this->route('user');
        return [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users','username')->ignore($user->id)], //se aplica la regla que debe ser un username unico, pero se ignora para ese id en el update.
            'email' => ['required', 'email',  Rule::unique('users','email')->ignore($user->id)], //se aplica la regla que debe ser un email unico, pero se ignora para ese id en el update.
        ];
    }
}
