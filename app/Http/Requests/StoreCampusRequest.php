<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCampusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('campus.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'name' => ['required', 'max:255'],
        'email' => ['nullable', 'email'],
        'university_id' => ['required', 'exists:universities,id'],
        'phone' => ['nullable'],
        'country' => ['nullable'],
        'state' => ['nullable'],
        'city' => ['nullable'],
        'address' => ['nullable'],
        'description' => ['nullable'],
    ];
    }
}
