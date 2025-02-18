<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'room_id'     => ['required', 'exists:rooms,id'],
            'user_id'     => ['required', 'exists:users,id'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_time'  => ['required', 'date', 'after_or_equal:now'],
            'end_time'    => ['required', 'date', 'after:start_time'],
            'status'      => ['required', 'in:pending,confirmed,canceled'],
        ];
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'room_id.required'     => 'A sala é obrigatória.',
            'room_id.exists'       => 'A sala selecionada não existe.',
            'user_id.required'     => 'O usuário é obrigatório.',
            'user_id.exists'       => 'O usuário selecionado não existe.',
            'title.required'       => 'O título é obrigatório.',
            'title.max'            => 'O título não pode ter mais de 255 caracteres.',
            'start_time.required'  => 'O horário de início é obrigatório.',
            'start_time.date'      => 'O horário de início deve ser uma data válida.',
            'start_time.after_or_equal' => 'O horário de início deve ser no presente ou futuro.',
            'end_time.required'    => 'O horário de término é obrigatório.',
            'end_time.date'        => 'O horário de término deve ser uma data válida.',
            'end_time.after'       => 'O horário de término deve ser depois do horário de início.',
            'status.required'      => 'O status é obrigatório.',
            'status.in'            => 'O status deve ser "pending", "confirmed" ou "canceled".',
        ];
    }
}
