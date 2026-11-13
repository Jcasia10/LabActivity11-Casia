@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Casia')

@section('content')
    <div class="mb-8">
        <p class="mb-2 text-sm font-bold uppercase tracking-[0.18em] text-[#2f7d45]">Your community, informed</p>
        <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Community announcements</h1>
        <p class="mt-2 max-w-2xl text-slate-600">Stay updated with the latest news, schedules, and helpful updates from our barangay.</p>
    </div>

    <form method="GET" action="{{ route('posts.index') }}" class="content-card mb-8 grid gap-3 rounded-2xl bg-white/85 p-4 backdrop-blur sm:grid-cols-2 lg:grid-cols-[minmax(0,1.4fr)_minmax(170px,0.8fr)_minmax(170px,0.8fr)_auto] lg:items-end">
        <label class="sr-only" for="q">Search announcements</label>
        <div class="relative">
            <input id="q" name="q" value="{{ request('q') }}" placeholder="Search announcements" autocomplete="off" class="w-full rounded-xl border-slate-300 px-4 py-2.5 pr-10">
            <button type="button" id="clear-search" aria-label="Clear search" title="Clear search" class="absolute right-3 top-1/2 -translate-y-1/2 text-lg leading-none text-slate-400 transition hover:text-slate-700" @if (!request('q')) hidden @endif>&times;</button>
        </div>
        <label class="sr-only" for="category">Category</label>
        <select id="category" name="category" class="rounded-xl border-slate-300 px-4 py-2.5">
            <option value="">All categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
            @endforeach
        </select>
        <select id="tag" name="tag" class="rounded-xl border-slate-300 px-4 py-2.5">
            <option value="">All tags</option>
            @foreach ($tags as $tag)
                <option value="{{ $tag->name }}" @selected(request('tag') === $tag->name)>{{ $tag->name }}</option>
            @endforeach
        </select>
        <button class="primary-button rounded-xl bg-[#0d5421] px-6 py-2.5 font-semibold text-white hover:bg-green-800">Filter</button>
    </form>

    <div class="grid gap-5 md:grid-cols-2">
        @forelse ($posts as $post)
            <article class="post-card rounded-2xl bg-white p-6" data-post-search="{{ strtolower($post->title . ' ' . $post->body . ' ' . $post->category . ' ' . $post->tags->pluck('name')->implode(' ')) }}">
                <div class="mb-3 flex flex-wrap items-center gap-2 text-sm">
                    <span class="rounded-full bg-green-100 px-3 py-1 text-[#0d5421]">{{ $post->category }}</span>
                    @foreach ($post->tags as $tag)
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-slate-600">{{ $tag->name }}</span>
                    @endforeach
                    @if ($post->is_pinned)
                        <span class="rounded-full bg-amber-100 px-3 py-1 font-semibold text-amber-800">Pinned</span>
                    @endif
                </div>
                <h2 class="text-xl font-bold text-slate-900">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:text-[#0d5421]">{{ $post->title }}</a>
                </h2>
                <p class="mt-2 text-sm font-medium text-[#0d5421]">Posted by {{ $post->author->name }}</p>
                <p class="mt-3 line-clamp-3 text-slate-600">{{ $post->body }}</p>
                <div class="mt-5 flex justify-between border-t border-slate-100 pt-4 text-sm text-slate-500">
                    <span>{{ $post->published_at?->format('M d, Y') }}</span>
                    <span>{{ $post->comments_count }} comments &middot; {{ $post->views }} views</span>
                </div>
            </article>
        @empty
            <p class="rounded-xl bg-white p-6 text-slate-600 shadow">No posts match your search.</p>
        @endforelse
    </div>
    <p id="live-search-empty" hidden class="mt-5 rounded-2xl border border-slate-300 bg-white p-6 text-slate-600 shadow-sm">No announcements match your search.</p>

    <div class="mt-8">{{ $posts->links() }}</div>
    @if ($posts->total() > 0)
        <p class="mt-3 text-sm text-slate-600">Showing {{ $posts->firstItem() }}-{{ $posts->lastItem() }} of {{ $posts->total() }} posts</p>
    @endif
@endsection
