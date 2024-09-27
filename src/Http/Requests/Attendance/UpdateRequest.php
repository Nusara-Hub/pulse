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
    'employee_id' => ['required'],
    'reason_id' => ['required'],
    'shiftment_id' => ['required'],
    'attendance_date' => ['required'],
    'description' => ['nullable'],
    'check_in' => ['nullable'],
    'check_out' => ['nullable'],
];
    }
}
