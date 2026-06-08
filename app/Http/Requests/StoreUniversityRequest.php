<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUniversityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->can('university.create');
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'country' => 'nullable|max:100',
            'state' => 'nullable|max:100',
            'city' => 'nullable|max:100',
            'address' => 'nullable',
        ];
    }
}