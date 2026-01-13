<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Teacher Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">
<div class="min-h-screen flex">

    {{-- ================= SIDEBAR (MATCH STUDENT) ================= --}}
    <aside class="w-64 shrink-0 flex flex-col text-white
                  bg-gradient-to-b from-sky-500 via-blue-600 to-indigo-600
                  shadow-2xl">

        {{-- LOGO --}}
        <div class="px-6 py-6 border-b border-white/10">
            <h2 class="text-lg font-extrabold tracking-tight">
                🧑‍🏫 Teacher Panel
            </h2>
            <p class="text-xs text-white/70 mt-1">
                Teaching Dashboard
            </p>
        </div>

        {{-- NAV --}}
        <nav class="flex-1 px-4 py-6 space-y-2 text-sm font-semibold">

            {{-- IMPORTANT: no teacher.dashboard in your project --}}
            <a href="{{ route('teacher.modules.index') }}"
               class="block px-4 py-3 rounded-xl transition
               {{ request()->routeIs('teacher.modules.*')
                    ? 'bg-white/20 ring-1 ring-white/30'
                    : 'hover:bg-white/10' }}">
                📚 My Modules
            </a>

        </nav>

        {{-- LOGOUT --}}
        <div class="p-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="w-full rounded-xl bg-white/15 hover:bg-white/25
                           px-4 py-2 text-sm font-semibold transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ================= MAIN ================= --}}
    <div class="flex-1 flex flex-col">

        {{-- ================= HEADER (MATCH STUDENT) ================= --}}
        @php
            $hour = now()->hour;
            $greeting =
                $hour < 12 ? 'Good Morning' :
                ($hour < 17 ? 'Good Afternoon' : 'Good Evening');
            $name = auth()->user()->name ?? 'Teacher';
            $initial = strtoupper(substr($name, 0, 1));
        @endphp

        <header class="relative overflow-hidden
                       bg-gradient-to-r from-sky-400 via-blue-500 to-indigo-500
                       px-10 py-10 text-white shadow-md">

            {{-- Decorative glows --}}
            <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-white/15 blur-3xl"></div>
            <div class="absolute -right-32 -bottom-32 h-96 w-96 rounded-full bg-white/10 blur-3xl"></div>

            <div class="relative flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight leading-tight">
                        {{ $greeting }}, {{ $name }} 👋
                    </h1>
                    <p class="mt-2 text-sm text-white/85 max-w-xl">
                        Welcome back to your teacher dashboard.
                        View assigned modules, manage students, and set pass/fail results.
                    </p>
                </div>

                {{-- Avatar --}}
                <div class="hidden sm:flex h-14 w-14 rounded-full
                            bg-white/25 ring-2 ring-white/30
                            items-center justify-center
                            text-lg font-extrabold">
                    {{ $initial }}
                </div>
            </div>
        </header>

        {{-- ================= CONTENT ================= --}}
        <main class="flex-1 px-8 py-8">
            @yield('content')
        </main>

    </div>
</div>
</body>
</html>
