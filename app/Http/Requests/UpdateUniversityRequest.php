<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUniversityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->can('university.edit');
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'short_name' => 'nullable|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|max:50',
            'website' => 'nullable|url',
            'description' => 'nullable',
            'country' => 'nullable|max:100',
            'state' => 'nullable|max:100',
            'city' => 'nullable|max:100',
            'address' => 'nullable',
            'status' => 'required|in:active,inactive',
        ];
    }
}