<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogPublicController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(6);
        return view('blog.index', compact('blogs'));
    }

    public function show(\App\Models\Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }
}

