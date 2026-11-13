@extends('layouts.app')

@section('title', 'New post – Barangay Bulletin')

@section('content')
    <div class="mx-auto max-w-2xl rounded-xl bg-white p-6 shadow">
        <h1 class="text-2xl font-bold">Create a new post</h1>
        @if ($errors->any())
            <div class="mt-4 rounded-lg bg-red-100 p-4 text-red-800">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        <form method="POST" action="{{ route('posts.store') }}" class="mt-6 space-y-4">
            @csrf
            <div><label for="title" class="font-semibold">Title</label><input id="title" name="title" value="{{ old('title') }}" class="mt-1 w-full rounded-lg border-slate-300">@error('title')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
            <div><label for="category" class="font-semibold">Category</label><select id="category" name="category" class="mt-1 w-full rounded-lg border-slate-300">@foreach (['Announcement', 'Health', 'Peace & Order', 'Ayuda', 'Community'] as $category)<option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>@endforeach</select>@error('category')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
            <div><label for="body" class="font-semibold">Body</label><textarea id="body" name="body" rows="7" class="mt-1 w-full rounded-lg border-slate-300">{{ old('body') }}</textarea>@error('body')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
            <fieldset><legend class="font-semibold">Tags</legend><div class="mt-2 flex flex-wrap gap-4">@foreach ($tags as $tag)<label><input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tags', [])))> {{ $tag->name }}</label>@endforeach</div>@error('tags')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</fieldset>
            <label><input type="checkbox" name="is_published" value="1" @checked(old('is_published'))> Publish now</label>
            <button class="block rounded-lg bg-[#0d5421] px-5 py-2 font-semibold text-white">Save post</button>
        </form>
    </div>
@endsection
