<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use App\Repositories\Interfaces\BlogRepositoryInterface;
use App\SEO\Models\SeoMeta;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct(
        BlogRepositoryInterface $blogRepository
    ) {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Blog List
     */
    public function index()
    {
        $blogs = $this->blogRepository
            ->paginate(15);
        return view(
            'backend.pages.blogs.index',
            compact('blogs')
        );
    }

    /**
     * Create Page
     */
    public function create()
    {
        return view(
            'backend.pages.blogs.create',
            [
                'blog' => null,
            ]
        );
    }

    /**
     * Store Blog
     */
public function store(BlogStoreRequest $request)
{
    $data = $request->validated();
    $blogData = [];

    DB::beginTransaction();

    try {

        $blogData = Arr::only($data, [
            'title',
            'short_description',
            'content',
            'category_id',
            'status',
        ]);

        $blogData['slug'] = $this->generateUniqueSlug($request->title);
        $blogData['author_id'] = auth()->id();
        $blogData['is_featured'] = $request->boolean('is_featured');

        if ($request->status === 'published') {
            $blogData['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {

            $file = $request->file('featured_image');

            $destinationPath = public_path('uploads/blogs');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move($destinationPath, $fileName);

            $blogData['featured_image'] = 'uploads/blogs/' . $fileName;
        }

        $blog = $this->blogRepository->create($blogData);

        $seoData = Arr::only($data, [
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]);

        $seoData['path'] = $this->uniqueSeoPathForSlug($blog->slug, 'blogs');

        $blog->seoMeta()->create($seoData);

        DB::commit();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()
            ->withInput()
            ->with('error', $e->getMessage());
    }
}

    /**
     * Edit Page
     */
    public function edit(Blog $blog)
    {
        $blog->load('seoMeta');

        return view(
            'backend.pages.blogs.edit',
            [
                'blog' => $blog,
                'seo' => $blog->seoMeta,
            ]
        );
    }

    /**
     * Update Blog
     */
  public function update(
    BlogUpdateRequest $request,
    Blog $blog
) {
    $data = [];
    $blogData = [];

    DB::beginTransaction();

    try {

        $data = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */
        $slug = $blog->slug;

        if ($blog->title !== $request->title) {
            $slug = $this->generateUniqueSlug($request->title, $blog->id);
        }

        $blogData = Arr::only($data, [
            'title',
            'short_description',
            'content',
            'category_id',
            'status',
        ]);

        $blogData['slug'] = $slug;
        $blogData['is_featured'] = $request->boolean('is_featured');

        if ($request->status === 'published' && !$blog->published_at) {
            $blogData['published_at'] = now();
        }

        /*
        |--------------------------------------------------------------------------
        | OLD IMAGE
        |--------------------------------------------------------------------------
        */
        $oldFeaturedImage = $blog->featured_image;

        /*
        |--------------------------------------------------------------------------
        | NEW IMAGE UPLOAD (PUBLIC FOLDER FIX)
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('featured_image')) {

            $file = $request->file('featured_image');

            $destinationPath = public_path('uploads/blogs');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move($destinationPath, $fileName);

            $blogData['featured_image'] = 'uploads/blogs/' . $fileName;
        }

        /*
        |--------------------------------------------------------------------------
        | APPLY DATA
        |--------------------------------------------------------------------------
        */
        $blog->fill($blogData);

        if (!$blog->isDirty()) {
            return redirect()
                ->route('admin.blogs.edit', $blog)
                ->with('success', 'No changes to update.');
        }

        DB::commit(); // commit BEFORE file delete + save

        /*
        |--------------------------------------------------------------------------
        | DELETE OLD IMAGE
        |--------------------------------------------------------------------------
        */
        if (
            $request->hasFile('featured_image') &&
            $oldFeaturedImage &&
            file_exists(public_path($oldFeaturedImage))
        ) {
            unlink(public_path($oldFeaturedImage));
        }

        $blog->save();

        /*
        |--------------------------------------------------------------------------
        | SEO UPDATE
        |--------------------------------------------------------------------------
        */
        $seoData = Arr::only($data, [
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]);

        $seo = $blog->seoMeta;

        if (!$seo) {
            $seo = $blog->seoMeta()->create([
                'path' => $this->uniqueSeoPathForSlug($blog->slug, 'blogs'),
            ]);
        }

        $seoData['path'] = $this->uniqueSeoPathForSlug(
            $blog->slug,
            'blogs',
            $seo->id
        );

        $seo->update($seoData);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()
            ->withInput()
            ->with('error', $e->getMessage());
    }
}

    /**
     * Delete Blog
     */
    public function destroy(Blog $blog)
    {
        DB::beginTransaction();

        try {

            if (
                $blog->featured_image &&
                Storage::disk('public')->exists(
                    $blog->featured_image
                )
            ) {

                Storage::disk('public')
                    ->delete(
                        $blog->featured_image
                    );
            }

            if ($blog->seoMeta?->og_image && Storage::disk('public')->exists($blog->seoMeta->og_image)) {
                Storage::disk('public')->delete($blog->seoMeta->og_image);
            }

            if ($blog->seoMeta?->twitter_image && Storage::disk('public')->exists($blog->seoMeta->twitter_image)) {
                Storage::disk('public')->delete($blog->seoMeta->twitter_image);
            }

            $blog->seoMeta()->delete();

            $blog->delete();

            DB::commit();

            return redirect()
                ->route('admin.blogs.index')
                ->with(
                    'success',
                    'Blog deleted successfully.'
                );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    /**
     * Generate Unique Slug
     */
    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);

        $query = Blog::where('slug', 'LIKE', "{$slug}%");
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $count = $query->count();

        return $count ? "{$slug}-" . ($count + 1) : $slug;
    }

    private function uniqueSeoPathForSlug(string $slug, string $prefix, ?int $ignoreSeoId = null): string
    {
        $base = $prefix . '/' . $slug;

        $query = SeoMeta::where('path', $base);
        if ($ignoreSeoId) {
            $query->where('id', '!=', $ignoreSeoId);
        }

        if (!$query->exists()) {
            return $base;
        }

        return $base . '-' . now()->timestamp;
    }
}
