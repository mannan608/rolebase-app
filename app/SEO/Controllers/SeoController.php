<?php

namespace App\SEO\Controllers;

use App\Http\Controllers\Controller;
use App\SEO\Models\SeoMeta;
use App\SEO\Requests\StoreSeoRequest;
use App\SEO\Requests\UpdateSeoRequest;
use App\Traits\CourseTrait;
use App\Traits\RouteDiscoveryTrait;
use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    use CourseTrait, RouteDiscoveryTrait;
    public function index()
    {
        $items = SeoMeta::latest()->paginate(20);

        return view('backend.pages.seo.index', compact('items'));
    }

    public function create()
    {
        $routes = $this->getRouteList();

        return view('backend.pages.seo.create', compact('routes'));
    }

  public function store(StoreSeoRequest $request)
{
    $data = $request->validated();

    $data['path'] = $data['type'];

    unset($data['type']);

    /*
    |--------------------------------------------------------------------------
    | OG IMAGE
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('og_image')) {

        $ogImage = $request->file('og_image');

        $ogImageName = time() . '_og_' . $ogImage->getClientOriginalName();

        $ogImage->move(
            public_path('uploads/seo/og-images'),
            $ogImageName
        );

        $data['og_image'] = 'uploads/seo/og-images/' . $ogImageName;
    }

    /*
    |--------------------------------------------------------------------------
    | TWITTER IMAGE
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('twitter_image')) {

        $twitterImage = $request->file('twitter_image');

        $twitterImageName = time() . '_twitter_' . $twitterImage->getClientOriginalName();

        $twitterImage->move(
            public_path('uploads/seo/twitter-images'),
            $twitterImageName
        );

        $data['twitter_image'] = 'uploads/seo/twitter-images/' . $twitterImageName;
    }

    /*
    |--------------------------------------------------------------------------
    | SCRIPTS
    |--------------------------------------------------------------------------
    */

    $data['header_scripts'] = array_values(
        array_filter($data['header_scripts'] ?? [])
    );

    $data['footer_scripts'] = array_values(
        array_filter($data['footer_scripts'] ?? [])
    );

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    SeoMeta::create($data);

    return redirect()
        ->route('admin.seo.index')
        ->with('success', 'SEO data created successfully.');
}

    public function edit(SeoMeta $seo)
    {
        $routes = $this->getRouteList();

        return view('backend.pages.seo.edit', compact(
            'seo',
            'routes'
        ));
    }

    public function update(UpdateSeoRequest $request, SeoMeta $seo)
    {
        $data = $this->filledUpdateData($request->validated());

        if ($request->hasFile('og_image')) {

            if ($seo->og_image) {
                Storage::disk('public')->delete($seo->og_image);
            }

            $data['og_image'] = $request->file('og_image')
                ->store('seo/og-images', 'public');
        }


        if ($request->hasFile('twitter_image')) {

            if ($seo->twitter_image) {
                Storage::disk('public')->delete($seo->twitter_image);
            }

            $data['twitter_image'] = $request->file('twitter_image')
                ->store('seo/twitter-images', 'public');
        }


        $headerScripts = $this->filledScripts($request->input('header_scripts', []));

        if ($headerScripts !== []) {
            $data['header_scripts'] = $headerScripts;
        }

        $footerScripts = $this->filledScripts($request->input('footer_scripts', []));

        if ($footerScripts !== []) {
            $data['footer_scripts'] = $footerScripts;
        }

        $seo->update($data);

        return redirect()
            ->route('admin.seo.index')
            ->with('success', 'SEO data updated successfully.');
    }

    private function filledUpdateData(array $data): array
    {
        unset(
            $data['og_image'],
            $data['twitter_image'],
            $data['header_scripts'],
            $data['footer_scripts']
        );

        return array_filter($data, function ($value, $key) {
            if ($key === 'is_active') {
                return true;
            }

            if (is_string($value)) {
                return trim($value) !== '';
            }

            if (is_array($value)) {
                return $value !== [];
            }

            return ! is_null($value);
        }, ARRAY_FILTER_USE_BOTH);
    }

    private function filledScripts(array $scripts): array
    {
        return array_values(array_filter($scripts, function ($script) {
            return is_string($script) && trim($script) !== '';
        }));
    }

    public function destroy(SeoMeta $seo)
    {
        if ($seo->og_image) {
            Storage::disk('public')->delete($seo->og_image);
        }

        if ($seo->twitter_image) {
            Storage::disk('public')->delete($seo->twitter_image);
        }

        $seo->delete();

        return redirect()
            ->back()
            ->with('success', 'SEO data deleted successfully.');
    }
}
