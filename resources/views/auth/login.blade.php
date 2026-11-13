@extends('layouts.app')

@section('title', 'Log in – Barangay Bulletin')

@section('content')
    <div class="content-card mx-auto max-w-md rounded-2xl bg-white p-6 sm:p-8">
        <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#2f7d45]">Welcome back</p>
        <h1 class="mt-1 text-2xl font-bold">Resident login</h1>
        @if ($errors->any())
            <div class="mt-4 rounded-lg bg-red-100 p-4 text-red-800">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="email" class="font-semibold">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" class="mt-1 w-full rounded-xl border-slate-300 px-4 py-2.5">
                @error('email')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="password" class="font-semibold">Password</label>
                <input id="password" name="password" type="password" class="mt-1 w-full rounded-xl border-slate-300 px-4 py-2.5">
                @error('password')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <button class="primary-button rounded-xl bg-[#0d5421] px-5 py-2.5 font-semibold text-white">Log in</button>
        </form>
    </div>
@endsection
