<?php

declare(strict_types=1);

namespace Nusara\Pulse\Http\Requests\City;

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
    'code' => ['required', 'max:255'],
    'name' => ['required', 'max:255'],
    'region_id' => ['required'],
];
    }
}
