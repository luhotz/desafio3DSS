<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'court_id' => ['required', 'exists:courts,id'],
            'reservation_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'status' => ['required', Rule::in(['Pendiente', 'Confirmada', 'Cancelada', 'Finalizada'])],
            'notes' => ['nullable', 'string', 'max:500'],
            'services' => ['nullable', 'array'],
            'services.*' => ['exists:services,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Debe seleccionar un cliente.',
            'court_id.required' => 'Debe seleccionar una cancha.',
            'reservation_date.after_or_equal' => 'La fecha no puede ser anterior a hoy.',
            'end_time.after' => 'La hora final debe ser mayor que la hora inicial.',
        ];
    }
}
