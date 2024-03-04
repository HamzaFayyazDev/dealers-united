<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageCapsuleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'note' => 'required|string|min:1', // Message cannot be empty
            'scheduled_opening_time' => 'required|date|after:now', // Scheduled time should be greater than today's time
            'is_opened' => 'prohibited', // is_opened cannot be passed
        ];
    }
}
