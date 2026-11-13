<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->with(['author', 'tags'])
            ->withCount('comments')
            ->where('is_published', true)
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%' . $request->string('q') . '%'))
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')))
            ->when($request->filled('tag'), fn ($query) => $query->whereHas('tags', fn ($tags) => $tags->where('name', $request->string('tag'))))
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(6)
            ->withQueryString();

        $categories = Post::query()->distinct()->orderBy('category')->pluck('category');
        $tags = Tag::orderBy('name')->get();

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    public function create()
    {
        return view('posts.create', ['tags' => Tag::orderBy('name')->get()]);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $tagIds = $data['tags'];
        unset($data['tags']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        $post = $request->user()->author->posts()->create($data);
        $post->tags()->sync($tagIds);

        return redirect()->route('posts.show', $post);
    }

    public function show(int $id)
    {
        $post = Post::query()
            ->with(['author', 'tags'])
            ->where('is_published', true)
            ->findOrFail($id);

        $post->views++;
        $post->save();
        $post->load('comments.user');
        $post->setRelation('comments', $post->comments->sortByDesc('created_at')->values());

        return view('posts.show', compact('post'));
    }
}
