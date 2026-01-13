@props(['title' => 'Admin'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Educational Admmin Site') }} - {{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="page-canvas">
<div class="min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-72 p-5">
        <div class="sidebar">

            <div class="flex items-center gap-3">
                <div class="h-12 w-12 rounded-2xl flex items-center justify-center text-white font-black"
                     style="background-image: linear-gradient(110deg,#0ea5e9 0%,#22d3ee 40%,#6366f1 95%); box-shadow: 0 18px 45px rgba(2,132,199,.25);">
                    A
                </div>
                <div>
                    <div class="font-black text-slate-900 leading-tight">Admin Dashboard </div>
                </div>
            </div>

            <nav class="mt-8 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'nav-link nav-active' : 'nav-link' }}">
                    <span class="nav-icon">D</span>
                    Dashboard
                </a>

                <a href="{{ route('admin.modules.index') }}"
                   class="{{ request()->routeIs('admin.modules.*') ? 'nav-link nav-active' : 'nav-link' }}">
                    <span class="nav-icon">M</span>
                    Modules
                </a>

                <a href="{{ route('admin.teachers.index') }}"
                   class="{{ request()->routeIs('admin.teachers.*') ? 'nav-link nav-active' : 'nav-link' }}">
                    <span class="nav-icon">T</span>
                    Teachers
                </a>

                <a href="{{ route('admin.students.index') }}"
                   class="{{ request()->routeIs('admin.students.index') ? 'nav-link nav-active' : 'nav-link' }}">
                    <span class="nav-icon">S</span>
                    Students
                </a>

                <a href="{{ route('admin.students.old') }}"
                   class="{{ request()->routeIs('admin.students.old') ? 'nav-link nav-active' : 'nav-link' }}">
                    <span class="nav-icon">O</span>
                    Old Students
                </a>
            </nav>

            <div class="mt-auto pt-6 border-t border-white/70">
                <div class="text-xs text-slate-500">Logged in as</div>
                <div class="font-semibold text-slate-900">{{ auth()->user()->name }}</div>

                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn-ghost w-full">Logout</button>
                </form>
            </div>

        </div>
    </aside>

    {{-- Main --}}
    <div class="flex-1 p-5 pl-0">
        <header class="topbar">
            <div class="relative z-10 flex items-center justify-between gap-4">
                <div>
                    <div class="text-white text-2xl font-black tracking-tight">Educational Admin Site</div>
                    <div class="text-white/85 text-sm font-semibold -mt-0.5">Administrator Dashboard</div>
                </div>

                <form method="GET" action="#" class="hidden md:block">
                    <input type="text" placeholder="Search..."
                           class="w-72 rounded-2xl border border-white/40 bg-white/20 px-4 py-2.5 text-white placeholder:text-white/70
                                  focus:outline-none focus:ring-2 focus:ring-white/60" />
                </form>
            </div>
        </header>

        <main class="mt-6">

            {{-- Global Alerts --}}
            @if (session('success'))
                <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-800">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-amber-900">
                    <div class="font-semibold mb-1">Please fix the following:</div>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

</div>
</body>
</html>
