<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Requests\Employee;

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
    'user_id' => ['max:255'],
    'contract_id' => ['required'],
    'email' => ['required'],
    'company_id' => ['nullable'],
    'department_id' => ['required'],
    'job_level_id' => ['required'],
    'job_title_id' => ['required'],
    'supervisor_id' => ['nullable'],
    'fullname' => ['required'],
    'code' => ['required'],
    'gender' => ['required'],
    'place_of_birth' => ['nullable'],
    'identity_type' => ['required'],
    'identity_number' => ['required'],
    'martial_status' => ['nullable'],
    'email' => ['nullable'],
    'employee_status' => ['required'],
    'profile_image' => ['nullable','image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
    'risk_ratio' => ['nullable'],
    'date_of_birth' => ['nullable'],
    'resign_date' => ['nullable'],
    'join_date' => ['required'],
    'leave_balance' => ['nullable'],
    'education_institute_id' => ['nullable'],
    'education_title_id' => ['nullable'],
];
    }
}
