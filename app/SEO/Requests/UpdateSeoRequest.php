<?php

namespace App\SEO\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSeoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $seo = $this->route('seo');
        $seoId = is_object($seo) ? $seo->id : $seo;

        return [
            'path' => ['required', 'string', Rule::unique('seo_metas', 'path')->ignore($seoId)],

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
            'meta_keywords' => 'nullable|string|max:1000',

            'robots' => 'nullable|string|max:50',

            'canonical_url' => 'nullable|url|max:255',

            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:1000',
            'og_image' => 'nullable|file|mimetypes:image/png,image/jpeg,image/jpg,image/webp,image/svg+xml|max:5120',
            'og_type' => 'nullable|string|max:50',

            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string|max:1000',
            'twitter_image' => 'nullable|file|mimetypes:image/png,image/jpeg,image/jpg,image/webp,image/svg+xml|max:5120',

            'schema_markup' => 'nullable|string',
              'header_scripts' => 'nullable|array',
            'header_scripts.*' => 'nullable|string',

            'footer_scripts' => 'nullable|array',
            'footer_scripts.*' => 'nullable|string',

            'is_active' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'path.required' => 'Please select a page or route.',

            'canonical_url.url' => 'Please enter a valid canonical URL.',
             'header_scripts.array' => 'Header scripts format is invalid.',
            'footer_scripts.array' => 'Footer scripts format is invalid.',

            'is_active.boolean' => 'Invalid status selected.',
        ];
    }
}
