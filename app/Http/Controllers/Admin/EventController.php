<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use App\Repositories\Interfaces\EventRepositoryInterface;
use App\SEO\Models\SeoMeta;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    protected $eventRepository;

    public function __construct(
        EventRepositoryInterface $eventRepository
    ) {
        $this->eventRepository = $eventRepository;
    }

    /**
     * Events List
     */
    public function index()
    {
        $events = $this->eventRepository
            ->paginate(15);

        return view(
            'backend.pages.events.index',
            compact('events')
        );
    }

    /**
     * Create Page
     */
    public function create()
    {
        return view(
            'backend.pages.events.create',
            [
                'event' => null,
                'seo' => null,
            ]
        );
    }

    /**
     * Store Event
     */
    public function store(EventStoreRequest $request)
    {
        $data = $request->validated();

        $eventData = [];
        $seoData = [];

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | BUILD EVENT PAYLOAD
            |--------------------------------------------------------------------------
            */
            $eventData = $this->eventPayloadFromRequest($request, $data);

            $eventData['slug'] = $this->generateUniqueSlug($request->title);

            /*
            |--------------------------------------------------------------------------
            | IMAGE HANDLING FIX (PUBLIC UPLOADS)
            |--------------------------------------------------------------------------
            */

            // Helper function inside method scope style
            $uploadFile = function ($file, $folder = 'events') {

                $destinationPath = public_path("uploads/{$folder}");

                if (! file_exists($destinationPath)) {
                    mkdir($destinationPath, 0775, true);
                }

                $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

                $file->move($destinationPath, $fileName);

                return "uploads/{$folder}/{$fileName}";
            };

            /*
            |--------------------------------------------------------------------------
            | BANNER
            |--------------------------------------------------------------------------
            */
            if ($request->hasFile('banner')) {
                $eventData['banner'] = $uploadFile($request->file('banner'), 'events');
            }

            /*
            |--------------------------------------------------------------------------
            | GALLERY IMAGES
            |--------------------------------------------------------------------------
            */
            if ($request->hasFile('gallery_images')) {

                $gallery = [];

                foreach ($request->file('gallery_images') as $file) {
                    $gallery[] = $uploadFile($file, 'events/gallery');
                }

                $eventData['gallery_images'] = $gallery;
            }

            if (! empty($eventData['providers'])) {

                foreach ($eventData['providers'] as $key => $provider) {

                    if (isset($provider['logo_file']) && $provider['logo_file']) {
                        $eventData['providers'][$key]['logo'] =
                            $uploadFile($provider['logo_file'], 'events/providers');
                    }
                }
            }

            $event = $this->eventRepository->create($eventData);

            $seoData = $this->seoPayloadFromRequest($request, $data);

            $seoData['path'] = $this->uniqueSeoPathForSlug($event->slug);

            $event->seoMeta()->create($seoData);

            DB::commit();

            return redirect()
                ->route('role.events.index', ['role' => $request->route('role')])
                ->with('success', 'Event created successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show Event
     */
    public function show(string $role, Event $event)
    {
        return redirect()->route('role.events.edit', [
            'role' => $role,
            'event' => $event,
        ]);
    }

    /**
     * Edit Event
     */
    public function edit(string $role, Event $event)
    {
        $event->load('seoMeta');

        return view(
            'backend.pages.events.edit',
            [
                'event' => $event,
                'seo' => $event->seoMeta,
            ]
        );
    }

    /**
     * Update Event
     */
    public function update(EventUpdateRequest $request, string $role, Event $event)
    {
        $data = $request->validated();

        $oldBanner = $event->banner;
        $oldSeoOg = $event->seoMeta?->og_image;
        $oldSeoTwitter = $event->seoMeta?->twitter_image;
        $oldGallery = $event->gallery_images ?? [];
        $oldProviders = $event->providers ?? [];

        $slug = $event->slug;

        if ($event->title !== $request->title) {
            $slug = $this->generateUniqueSlug($request->title, $event->id);
        }

        DB::beginTransaction();

        try {
            $uploadFile = function ($file, $folder = 'events') {

                $destinationPath = public_path("uploads/{$folder}");

                if (! file_exists($destinationPath)) {
                    mkdir($destinationPath, 0775, true);
                }

                $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

                $file->move($destinationPath, $fileName);

                return "uploads/{$folder}/{$fileName}";
            };

            $eventData = $this->eventPayloadFromRequest($request, $data, $event);
            $eventData['slug'] = $slug;

            if ($request->hasFile('banner')) {

                $eventData['banner'] = $uploadFile($request->file('banner'), 'events');

                if ($oldBanner && file_exists(public_path($oldBanner))) {
                    unlink(public_path($oldBanner));
                }
            }

            $event->fill($eventData);
            $event->save();

            $seoData = $this->seoPayloadFromRequest($request, $data, $event->seoMeta);

            $seo = $event->seoMeta;

            if (! $seo) {
                $seo = $event->seoMeta()->create([
                    'path' => $this->uniqueSeoPathForSlug($event->slug),
                ]);
            }

            if ($request->hasFile('og_image')) {
                if ($oldSeoOg && file_exists(public_path($oldSeoOg))) {
                    unlink(public_path($oldSeoOg));
                }

                $seoData['og_image'] = $uploadFile($request->file('og_image'), 'events/seo');
            }

            if ($request->hasFile('twitter_image')) {
                if ($oldSeoTwitter && file_exists(public_path($oldSeoTwitter))) {
                    unlink(public_path($oldSeoTwitter));
                }

                $seoData['twitter_image'] = $uploadFile($request->file('twitter_image'), 'events/seo');
            }

            $seoData['path'] = $this->uniqueSeoPathForSlug($event->slug, $seo->id);

            $seo->update($seoData);

            $newGallery = $event->gallery_images ?? [];

            $removedGallery = array_diff($oldGallery, $newGallery);

            foreach ($removedGallery as $path) {
                if ($path && file_exists(public_path($path))) {
                    unlink(public_path($path));
                }
            }

            $newProviders = $event->providers ?? [];

            $oldLogos = array_filter(array_map(fn ($p) => $p['logo'] ?? null, $oldProviders));
            $newLogos = array_filter(array_map(fn ($p) => $p['logo'] ?? null, $newProviders));

            $removedProviderLogos = array_diff($oldLogos, $newLogos);

            foreach ($removedProviderLogos as $path) {
                if ($path && file_exists(public_path($path))) {
                    unlink(public_path($path));
                }
            }

            DB::commit();

            return redirect()
                ->route('role.events.index', ['role' => $request->route('role')])
                ->with('success', 'Event updated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Delete Event
     */
    public function destroy(string $role, Event $event)
    {
        DB::beginTransaction();

        try {
            if (
                $event->banner &&
                Storage::disk('public')->exists($event->banner)
            ) {
                Storage::disk('public')->delete($event->banner);
            }

            foreach (($event->gallery_images ?? []) as $path) {
                if ($path && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            foreach (($event->providers ?? []) as $provider) {
                $path = $provider['logo'] ?? null;
                if ($path && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            if ($event->seoMeta?->og_image && Storage::disk('public')->exists($event->seoMeta->og_image)) {
                Storage::disk('public')->delete($event->seoMeta->og_image);
            }

            if ($event->seoMeta?->twitter_image && Storage::disk('public')->exists($event->seoMeta->twitter_image)) {
                Storage::disk('public')->delete($event->seoMeta->twitter_image);
            }

            $event->delete();

            DB::commit();

            return redirect()
                ->route('role.events.index', ['role' => $role])
                ->with('success', 'Event deleted successfully.');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);

        $query = Event::where('slug', 'LIKE', "{$slug}%");
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $count = $query->count();

        return $count ? "{$slug}-".($count + 1) : $slug;
    }

    private function eventPayloadFromRequest(
        EventStoreRequest|EventUpdateRequest $request,
        array $validated,
        ?Event $event = null
    ): array {
        $eventData = Arr::only($validated, [
            'title',
            'short_description',
            'description',
            'organizer',
            'registration_link',
            'contact_email',
            'contact_phone',
            'google_map_link',
            'status',
        ]);

        $eventData['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('banner')) {
            $eventData['banner'] = $request->file('banner')->store('events', 'public');
        } elseif ($event) {
            $eventData['banner'] = $event->banner;
        }

        $schedules = $validated['schedules'] ?? [];
        $eventData['schedules'] = $this->compactArrayRows($schedules, ['location', 'start_date', 'end_date']);

        $faqs = $validated['faqs'] ?? [];
        $eventData['faqs'] = $this->compactArrayRows($faqs, ['question', 'answer']);

        $tagsString = $validated['tags'] ?? '';
        $eventData['tags'] = $this->tagsFromString($tagsString);

        $providers = $validated['providers'] ?? [];
        $eventData['providers'] = $this->providersPayload($request, $providers);

        $gallery = $event?->gallery_images ?? [];
        if ($request->hasFile('gallery_images')) {
            foreach ((array) $request->file('gallery_images') as $file) {
                if ($file) {
                    $gallery[] = $file->store('events/gallery', 'public');
                }
            }
        }
        $eventData['gallery_images'] = array_values(array_unique(array_filter($gallery)));

        return $eventData;
    }

    private function seoPayloadFromRequest(
        EventStoreRequest|EventUpdateRequest $request,
        array $validated,
        ?SeoMeta $seo = null
    ): array {
        $seoData = Arr::only($validated, [
            'meta_title',
            'meta_description',
            'meta_keywords',
            'robots',
            'canonical_url',
            'og_title',
            'og_description',
            'og_type',
            'twitter_title',
            'twitter_description',
            'schema_markup',
        ]);

        $seoData['header_scripts'] = $this->filledScripts($validated['header_scripts'] ?? []);
        $seoData['footer_scripts'] = $this->filledScripts($validated['footer_scripts'] ?? []);

        if ($request->hasFile('og_image')) {
            $seoData['og_image'] = $request->file('og_image')->store('seo/og-images', 'public');
        } elseif ($seo) {
            $seoData['og_image'] = $seo->og_image;
        }

        if ($request->hasFile('twitter_image')) {
            $seoData['twitter_image'] = $request->file('twitter_image')->store('seo/twitter-images', 'public');
        } elseif ($seo) {
            $seoData['twitter_image'] = $seo->twitter_image;
        }

        return $seoData;
    }

    private function filledScripts(array $scripts): array
    {
        return array_values(array_filter($scripts, function ($script) {
            return is_string($script) && trim($script) !== '';
        }));
    }

    private function tagsFromString(?string $tags): array
    {
        $tags = (string) $tags;
        $parts = array_map('trim', preg_split('/,/', $tags) ?: []);

        return array_values(array_filter($parts, fn ($t) => $t !== ''));
    }

    private function compactArrayRows(array $rows, array $allowedKeys): array
    {
        $rows = array_map(function ($row) use ($allowedKeys) {
            if (! is_array($row)) {
                return [];
            }

            $out = [];
            foreach ($allowedKeys as $key) {
                $value = $row[$key] ?? null;
                if (is_string($value)) {
                    $value = trim($value);
                }
                if ($value !== null && $value !== '') {
                    $out[$key] = $value;
                }
            }

            return $out;
        }, $rows);

        return array_values(array_filter($rows, fn ($row) => $row !== []));
    }

    private function providersPayload(
        EventStoreRequest|EventUpdateRequest $request,
        array $providers
    ): array {
        $result = [];

        foreach ($providers as $index => $provider) {
            $name = trim((string) ($provider['name'] ?? ''));
            $existingLogo = $provider['existing_logo'] ?? null;

            $logo = $existingLogo;
            if ($request->hasFile("providers.$index.logo")) {
                $logo = $request->file("providers.$index.logo")->store('events/providers', 'public');
            }

            if ($name === '' && ! $logo) {
                continue;
            }

            $row = [];
            if ($name !== '') {
                $row['name'] = $name;
            }
            if ($logo) {
                $row['logo'] = $logo;
            }

            $result[] = $row;
        }

        return $result;
    }

    private function uniqueSeoPathForSlug(string $slug, ?int $ignoreSeoId = null): string
    {
        $base = 'events/'.$slug;

        $query = SeoMeta::where('path', $base);
        if ($ignoreSeoId) {
            $query->where('id', '!=', $ignoreSeoId);
        }

        if (! $query->exists()) {
            return $base;
        }

        return $base.'-'.now()->timestamp;
    }
}
