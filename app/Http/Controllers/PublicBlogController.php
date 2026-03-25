<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class PublicBlogController extends Controller
{
    public function index()
    {
        // Select only necessary fields for listing
        $blogs = Blog::published()
            ->select('title', 'subtitle', 'image', 'slug', 'published_at')
            ->orderBy('published_at', 'desc')
            ->get();

        return view('blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::published()->where('slug', $slug)->firstOrFail();
        return view('blog.show', compact('blog'));
    }
}
