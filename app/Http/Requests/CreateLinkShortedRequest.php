<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLinkShortedRequest extends FormRequest
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
            'link' => 'url|required',
            'name' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'link.url' => 'Formato de URL informado não é válido.',
            'link.required' => 'O campo link é obrigatório.',
            'name.string' => 'O campo name deve ser no formato de texto',
        ];
    }
}
