<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Requests\Mutation;

use App\Traits\HandleJsonValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

final class CreateRequest extends FormRequest
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
    'old_supervisor_id' => ['nullable'],
    'old_department_id' => ['required'],
    'employee_id' => ['required'],
    'old_company_id' => ['nullable'],
    'old_job_level_id' => ['required'],
    'old_job_title_id' => ['required'],
    'contract_id' => ['required'],
    'type' => ['required'],
    'new_supervisor_id' => ['required'],
    'new_department_id' => ['required'],
    'new_company_id' => ['nullable'],
    'new_job_level_id' => ['required'],
    'new_job_title_id' => ['required'],
];
    }
}
