<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       return [

            'title' => 'required|string|max:255',

            'short_description' => 'nullable|string',

            'description' => 'required|string',

            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'schedules' => 'nullable|array',
            'schedules.*.location' => 'nullable|string|max:255',
            'schedules.*.start_date' => 'nullable|date',
            'schedules.*.end_date' => 'nullable|date',

            'organizer' => 'nullable|string|max:255',

            'registration_link' => 'nullable|url',

            'contact_email' => 'nullable|email',

            'contact_phone' => 'nullable|string|max:30',

            'providers' => 'nullable|array',
            'providers.*.name' => 'nullable|string|max:255',
            'providers.*.logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'providers.*.existing_logo' => 'nullable|string',

            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'tags' => 'nullable|string',

            'faqs' => 'nullable|array',
            'faqs.*.question' => 'nullable|string|max:255',
            'faqs.*.answer' => 'nullable|string|max:255',

            'google_map_link' => 'nullable|url',

            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
            'is_featured' => 'sometimes|boolean',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'robots' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'og_type' => 'nullable|string|max:50',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'twitter_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'schema_markup' => 'nullable|string',
            'header_scripts' => 'nullable|array',
            'header_scripts.*' => 'nullable|string',
            'footer_scripts' => 'nullable|array',
            'footer_scripts.*' => 'nullable|string',
        ];
    }
}
