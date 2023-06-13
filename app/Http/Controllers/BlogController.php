<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index()
    {

        return view('blogs.index', [

            'firstblog' => Blog::latest()->filter(request(['search', 'category', 'username']))->get(),

        ]);
    }

    public function show(Blog $wildcard)
    {
        return view('blogs.show', [
            'secondblog' => $wildcard,
            'random' => Blog::inRandomOrder()->take(3)->get()
        ]);
    }
}
