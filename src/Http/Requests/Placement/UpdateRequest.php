<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Requests\Placement;

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
    'supervisor_id' => ['nullable'],
    'department_id' => ['required'],
    'employee_id' => ['required'],
    'company_id' => ['nullable'],
    'job_level_id' => ['required'],
    'job_title_id' => ['required'],
    'contract_id' => ['required'],
    'is_active' => ['required'],
];
    }
}
