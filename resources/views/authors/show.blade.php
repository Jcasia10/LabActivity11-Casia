@extends('layouts.app')

@section('title', $author->name . ' – Barangay Bulletin')

@section('content')
    <div class="content-card rounded-2xl bg-white p-6">
        <h1 class="text-3xl font-bold">{{ $author->name }}</h1>
        <p class="mt-1 text-slate-600">{{ $author->position }}</p>
        <p class="mt-3 text-sm text-slate-600">{{ $author->comments_count }} comments received</p>
    </div>
    <div class="mt-6 grid gap-5 md:grid-cols-2">
        @forelse ($author->posts as $post)
            <article class="post-card rounded-2xl bg-white p-6">
                <h2 class="text-xl font-bold"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                <p class="mt-2 text-slate-600">{{ $post->body }}</p>
            </article>
        @empty
            <p class="text-slate-600">No published posts yet.</p>
        @endforelse
    </div>
@endsection
