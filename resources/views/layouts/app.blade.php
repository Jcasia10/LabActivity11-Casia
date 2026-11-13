<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'Barangay Bulletin – Purok Casia')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen text-slate-800">
    <header class="site-header text-white shadow-lg">
        <div class="mx-auto flex max-w-6xl flex-col gap-5 px-4 py-5 sm:px-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <a href="{{ route('posts.index') }}" class="text-2xl font-bold tracking-tight sm:text-3xl">Barangay Bulletin <span class="text-white">– Purok Casia</span></a>
                <p class="mt-1 text-sm text-green-100">Matina Crossing Hall announcements</p>
                @auth
                    <p class="mt-2 text-sm text-green-100">Signed in as <strong class="font-semibold text-white">{{ auth()->user()->name }}</strong></p>
                @endauth
            </div>
            <nav class="flex items-center gap-3 text-sm">
                <a href="{{ route('posts.index') }}" class="rounded-full border border-white/30 bg-white/10 px-4 py-2 font-semibold backdrop-blur transition hover:bg-white/20">Dashboard</a>
                @auth
                    @if (auth()->user()->author()->exists())
                        <a href="{{ route('posts.create') }}" class="rounded-full border border-white/30 bg-white/10 px-4 py-2 font-semibold backdrop-blur transition hover:bg-white/20">New post</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-full border border-white/30 px-4 py-2 font-semibold transition hover:bg-white/15">Log out</button>
                    </form>
                @else
                    @unless (request()->routeIs('login'))
                        <a href="{{ route('login') }}" class="rounded-full border border-white/70 bg-transparent px-5 py-2 font-bold text-white shadow-md transition hover:bg-white/15">Log in</a>
                    @endunless
                @endauth
            </nav>
        </div>
    </header>
    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6">
        @yield('content')
    </main>
</body>
</html>
