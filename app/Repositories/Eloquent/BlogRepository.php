<?php

namespace App\Repositories\Eloquent;

use App\Models\Blog;
use App\Repositories\Interfaces\BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface
{
    public function all()
    {
        return Blog::with('author', 'seoMeta')
            ->latest()
            ->get();
    }

    public function paginate($limit = 10)
    {
        return Blog::with('author', 'seoMeta')
            ->latest()
            ->paginate($limit);
    }

    public function findById($id)
    {
        return Blog::with('author', 'seoMeta')
            ->findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return Blog::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
    }

    public function create(array $data)
    {
        
        return Blog::create($data);
    }

    public function update($id, array $data)
    {
        $blog = $this->findById($id);

        $blog->update($data);

        return $blog;
    }

    public function delete($id)
    {
        return Blog::destroy($id);
    }
}
