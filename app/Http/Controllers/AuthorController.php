<?php

namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function show(Author $author)
    {
        $author->load([
            'posts' => fn ($query) => $query->where('is_published', true)->latest('published_at'),
        ]);
        $author->loadCount('comments');

        return view('authors.show', compact('author'));
    }
}
