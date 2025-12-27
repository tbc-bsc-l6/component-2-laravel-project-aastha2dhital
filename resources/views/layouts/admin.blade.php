<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 min-h-screen bg-gradient-to-b from-slate-900 to-slate-800
                  text-slate-100 shadow-xl flex flex-col">

        <div class="p-6 text-xl font-bold text-white border-b border-slate-700">
            Admin Panel
        </div>

        <nav class="flex-1 px-4 py-4 space-y-1 text-sm">
            @php
                $base = 'block px-4 py-2 rounded transition';
                $active = 'bg-slate-700 text-white font-semibold';
                $inactive = 'text-slate-300 hover:bg-slate-700 hover:text-white';
            @endphp

            <a href="{{ route('admin.dashboard') }}"
               class="{{ $base }} {{ request()->routeIs('admin.dashboard') ? $active : $inactive }}">
                Dashboard
            </a>

            <a href="{{ route('admin.modules.index') }}"
               class="{{ $base }} {{ request()->routeIs('admin.modules.*') ? $active : $inactive }}">
                Modules
            </a>

            <a href="{{ route('admin.teachers.index') }}"
               class="{{ $base }} {{ request()->routeIs('admin.teachers.*') ? $active : $inactive }}">
                Teachers
            </a>

            <a href="{{ route('admin.students.index') }}"
               class="{{ $base }} {{ request()->routeIs('admin.students.*') ? $active : $inactive }}">
                Students
            </a>

            <a href="{{ route('admin.old-students.index') }}"
               class="{{ $base }} {{ request()->routeIs('admin.old-students.*') ? $active : $inactive }}">
                Old Students
            </a>
        </nav>

        <div class="p-4 border-t border-slate-700 text-sm text-slate-300">
            Logged in as<br>
            <span class="font-semibold text-white">
                {{ auth()->user()->name }}
            </span>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="flex-1 flex flex-col bg-gray-100">

        <header class="bg-white border-b px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-gray-800">
                @yield('header')
            </h1>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-red-600 hover:underline">
                    Logout
                </button>
            </form>
        </header>

        <section class="p-8 flex-1">
            @yield('content')
        </section>

    </main>

</div>
</body>
</html>
