<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 antialiased">

<!-- ROOT WRAPPER -->
<div class="flex min-h-screen w-full overflow-x-hidden">

    {{-- ================= SIDEBAR ================= --}}
    <aside class="w-64 shrink-0
                  bg-gradient-to-b from-slate-900 to-slate-800
                  text-slate-100 shadow-xl flex flex-col">

        <div class="px-6 py-6 text-xl font-bold border-b border-white/10">
            🛠 Admin Panel
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
            @php
                $base = 'block px-4 py-3 rounded-xl font-semibold transition';
                $active = 'bg-white/10';
                $inactive = 'hover:bg-white/5';
            @endphp

            <a href="{{ route('admin.dashboard') }}"
               class="{{ $base }} {{ request()->routeIs('admin.dashboard') ? $active : $inactive }}">
                📊 Dashboard
            </a>

            <a href="{{ route('admin.modules.index') }}"
               class="{{ $base }} {{ request()->routeIs('admin.modules.*') ? $active : $inactive }}">
                📚 Modules
            </a>

            <a href="{{ route('admin.teachers.index') }}"
               class="{{ $base }} {{ request()->routeIs('admin.teachers.*') ? $active : $inactive }}">
                👩‍🏫 Teachers
            </a>

            <a href="{{ route('admin.students.index') }}"
               class="{{ $base }} {{ request()->routeIs('admin.students.*') ? $active : $inactive }}">
                🎓 Students
            </a>

            <a href="{{ route('admin.students.old') }}"
               class="{{ $base }} {{ request()->routeIs('admin.students.old') ? $active : $inactive }}">
                🕓 Old Students
            </a>
        </nav>

        <div class="p-4 border-t border-white/10 text-sm">
            <div class="text-white/70">Logged in as</div>
            <div class="font-semibold text-white">
                {{ auth()->user()->name }}
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button
                    class="w-full px-4 py-2 rounded-xl
                           bg-white/10 hover:bg-white/20 transition">
                    🚪 Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ================= MAIN ================= --}}
    <main class="flex-1 min-w-0 overflow-x-hidden p-8">

        {{-- HEADER --}}
        <div class="mb-8 rounded-3xl px-10 py-8
                    bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500
                    text-white shadow-xl">

            <h1 class="text-3xl font-bold">
                @yield('title', 'Admin Dashboard')
            </h1>

            @hasSection('subtitle')
                <p class="text-white/90 text-sm mt-1">
                    @yield('subtitle')
                </p>
            @endif
        </div>

        {{-- PAGE CONTENT --}}
        <div class="w-full overflow-x-auto">
            @yield('content')
        </div>

    </main>

</div>
</body>
</html>
