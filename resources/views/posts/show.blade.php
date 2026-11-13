@extends('layouts.app')

@section('title', $post->title . ' – Barangay Bulletin')

@section('content')
    <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-[#0d5421] hover:text-green-800">&larr; Back to bulletin</a>
    <article class="content-card mt-5 rounded-2xl bg-white p-6 sm:p-10">
        <div class="mb-4 flex flex-wrap items-center gap-2 text-sm">
            <span class="rounded-full bg-green-100 px-3 py-1 text-[#0d5421]">{{ $post->category }}</span>
            @if ($post->is_pinned)
                <span class="rounded-full bg-amber-100 px-3 py-1 font-semibold text-amber-800">Pinned</span>
            @endif
            @foreach ($post->tags as $tag)
                <span class="rounded-full bg-slate-100 px-3 py-1 text-slate-600">{{ $tag->name }}</span>
            @endforeach
        </div>
        <h1 class="text-3xl font-bold text-slate-900">{{ $post->title }}</h1>
        <p class="mt-2 text-sm font-medium text-[#0d5421]">Posted by <a class="underline" href="{{ route('authors.show', $post->author) }}">{{ $post->author->name }}</a></p>
        <p class="mt-2 text-sm text-slate-500">{{ $post->published_at?->format('F d, Y g:i A') }} &middot; {{ $post->views }} views</p>
        <div class="mt-8 whitespace-pre-line leading-8 text-slate-700">{{ $post->body }}</div>
    </article>

    @if (session('status'))
        <p class="mt-5 rounded-lg bg-green-100 p-4 text-green-800">{{ session('status') }}</p>
    @endif

    <section class="content-card mt-6 rounded-2xl bg-white p-6">
        <h2 class="text-xl font-bold">Comments <span class="text-sm font-normal text-slate-500">from the community</span></h2>
        @if ($errors->any())
            <div class="mt-4 rounded-lg bg-red-100 p-4 text-red-800">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        <div class="mt-4 space-y-4">
            @forelse ($post->comments as $comment)
                <div class="border-b border-slate-200 pb-3 last:border-0">
                    <p class="font-semibold">{{ $comment->user->name }}</p>
                    <p class="text-slate-700">{{ $comment->body }}</p>
                    <p class="text-xs text-slate-500">{{ $comment->created_at->format('M d, Y g:i A') }}</p>
                </div>
            @empty
                <p class="text-slate-600">No comments yet.</p>
            @endforelse
        </div>
        @auth
            <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-6">
                @csrf
                <label for="body" class="font-semibold">Add a comment</label>
                <textarea id="body" name="body" rows="3" class="mt-2 w-full rounded-xl border-slate-300 px-4 py-3">{{ old('body') }}</textarea>
                @error('body')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                <button class="primary-button mt-3 rounded-xl bg-[#0d5421] px-5 py-2.5 font-semibold text-white">Post comment</button>
            </form>
        @else
            <p class="mt-6"><a class="font-semibold text-[#0d5421] underline" href="{{ route('login') }}">Sign in to comment</a></p>
        @endauth
    </section>
@endsection
