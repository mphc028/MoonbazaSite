<?php

namespace App\Http\Controllers;

use App\Content;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.index', ['posts' => Content::posts()]);
    }

    public function show(string $slug)
    {
        $post = Content::posts()->firstWhere('slug', $slug);
        abort_if(! $post, 404);

        return view('blog.show', ['post' => $post]);
    }
}
