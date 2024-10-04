<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Requests\Attendance;

use App\Traits\HandleJsonValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class UpdateRequest extends FormRequest
{
    use HandleJsonValidation;

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
            'employee_id' => ['required', 'string'],  // Required and must be a string
            'reason_id' => ['nullable', 'string', 'required_if:is_absent,true'], // Conditionally required if absent
            'shiftment_id' => ['required', 'string'], // Required and must be a string
            'attendance_date' => ['required', 'date'], // Required and must be a valid date
            'description' => ['nullable', 'string'],  // Nullable string
            'check_in' => ['nullable', 'string', 'required_if:is_absent,false'], // Conditionally required if not absent
            'check_out' => ['nullable', 'string', 'required_if:is_absent,false'], // Conditionally required if not absent
        ];
    }
}
