<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Requests\SalaryAllowance;

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
    'year' => ['required'],
    'sallary_component_id' => ['required'],
    'month' => ['required'],
    'benefit_value' => ['required'],
];
    }
}
