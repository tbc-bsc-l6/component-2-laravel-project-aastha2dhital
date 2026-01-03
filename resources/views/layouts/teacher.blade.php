<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 antialiased">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-64 student-gradient text-white flex flex-col shadow-xl">
        <div class="px-6 py-6 text-xl font-bold border-b border-white/20">
            🎓 Teacher Panel
        </div>

        <nav class="flex-1 px-4 py-6">
            <a href="{{ route('teacher.modules.index') }}"
               class="block px-4 py-3 rounded-xl font-semibold
               {{ request()->routeIs('teacher.modules.*') ? 'bg-white/20' : '' }}">
                📘 My Modules
            </a>
        </nav>

        <div class="p-4 border-t border-white/20">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full px-4 py-3 rounded-xl bg-black/20">
                    🚪 Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="flex-1 px-8 py-8">

        {{-- SINGLE HEADER --}}
        <div class="mb-8 rounded-3xl px-10 py-8 student-gradient text-white shadow-xl">
            <h1 class="text-3xl font-bold">
                👋 Hello, {{ auth()->user()->name }}
            </h1>
            <p class="text-white/90 text-sm">
                Manage your assigned modules and students
            </p>
        </div>

        {{-- PAGE CONTENT ONLY --}}
        @yield('content')

    </main>
</div>

</body>
</html>
