<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 antialiased">

<div class="flex min-h-screen overflow-x-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gradient-to-b from-emerald-400 to-teal-300
                  text-white flex flex-col shadow-xl">

        <div class="px-6 py-6 text-xl font-bold border-b border-white/30">
            🛠 Admin Panel
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 text-sm font-semibold">

            @php
                $link = 'block px-4 py-3 rounded-xl transition';
                $active = 'bg-white/25';
                $inactive = 'hover:bg-white/20';
            @endphp

            <a href="{{ route('admin.dashboard') }}"
               class="{{ $link }} {{ request()->routeIs('admin.dashboard') ? $active : $inactive }}">
                📊 Dashboard
            </a>

            <a href="{{ route('admin.modules.index') }}"
               class="{{ $link }} {{ request()->routeIs('admin.modules.*') ? $active : $inactive }}">
                📚 Modules
            </a>

            <a href="{{ route('admin.teachers.index') }}"
               class="{{ $link }} {{ request()->routeIs('admin.teachers.*') ? $active : $inactive }}">
                👩‍🏫 Teachers
            </a>

            <a href="{{ route('admin.students.index') }}"
               class="{{ $link }} {{ request()->routeIs('admin.students.*') ? $active : $inactive }}">
                🎓 Students
            </a>

            <a href="{{ route('admin.students.old') }}"
               class="{{ $link }} {{ request()->routeIs('admin.students.old*') ? $active : $inactive }}">
                🕓 Old Students
            </a>

        </nav>

        <div class="p-4 border-t border-white/30 text-sm">
            <div class="text-white/80">
                Logged in as<br>
                <span class="font-bold">{{ auth()->user()->name }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button class="w-full py-2 rounded-xl bg-white/25 hover:bg-white/30 transition">
                    🚪 Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- MAIN --}}
    <main class="flex-1 px-10 py-10 bg-slate-50">
        {{ $slot }}
    </main>

</div>

</body>
</html>
