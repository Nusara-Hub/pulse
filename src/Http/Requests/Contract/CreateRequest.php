<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Requests\Contract;

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
    'type' => ['required', 'max:255'],
    'letter_number' => ['required', 'max:100'],
    'subject' => ['required', 'max:255'],
    'tags' => ['nullable'],
    'description' => ['required'],
    'start_date' => ['required'],
    'end_date' => ['required'],
    'signed_date' => ['nullable'],
    'used' => ['nullable'],
];
    }
}
