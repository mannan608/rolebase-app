<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
   public function index()
{
    $blogs = Blog::where('status', 'published')
        ->latest()
        ->paginate(12);

        // return $blogs;

    return view('frontend.pages.blogs.index', compact('blogs'));
}
public function show($slug)
{
    $blog = Blog::where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();

    $blog->increment('views');

    $latestBlogs = Blog::where('status', 'published')
        ->where('id', '!=', $blog->id)
        ->latest()
        ->take(5)
        ->get();

    return view(
        'frontend.pages.blogs.show',
        compact('blog', 'latestBlogs')
    );
}
}
