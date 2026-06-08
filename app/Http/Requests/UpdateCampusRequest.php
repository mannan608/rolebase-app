<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCampusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('campus.edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'university_id' => ['required', 'exists:universities,id'],
        'name' => ['required', 'max:255'],
        'email' => ['nullable', 'email'],
        'phone' => ['nullable'],
        'country' => ['nullable'],
        'state' => ['nullable'],
        'city' => ['nullable'],
        'address' => ['nullable'],
        'description' => ['nullable'],
    ];
    }
}
