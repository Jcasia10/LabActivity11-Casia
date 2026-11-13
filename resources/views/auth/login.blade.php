@extends('layouts.app')

@section('title', 'Log in – Barangay Bulletin')

@section('content')
    <div class="mx-auto max-w-md rounded-xl bg-white p-6 shadow">
        <h1 class="text-2xl font-bold">Resident login</h1>
        @if ($errors->any())
            <div class="mt-4 rounded-lg bg-red-100 p-4 text-red-800">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="email" class="font-semibold">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" class="mt-1 w-full rounded-lg border-slate-300">
                @error('email')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="password" class="font-semibold">Password</label>
                <input id="password" name="password" type="password" class="mt-1 w-full rounded-lg border-slate-300">
                @error('password')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <button class="rounded-lg bg-[#0d5421] px-5 py-2 font-semibold text-white">Log in</button>
        </form>
    </div>
@endsection
