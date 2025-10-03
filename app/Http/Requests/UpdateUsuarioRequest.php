<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "idUsuario" => "required|integer",
            "nombreUsuario" => "required|string|max:80",
            "telefono" => "required|string|max:10",
            "correo" => "required|string|max:50",
            "clave" => "required|string|max:150",
            "idRol" => "required|integer"
        ];
    }
}
