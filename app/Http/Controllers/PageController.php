<?php

namespace App\Http\Controllers;

use App\Content;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'page' => Content::page('home') ?? abort(404),
            'posts' => Content::posts()->take(3),
        ]);
    }

    public function show(string $slug)
    {
        abort_if($slug === 'home', 404);

        return view('pages.show', ['page' => Content::page($slug) ?? abort(404)]);
    }
}
