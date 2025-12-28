<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

<div class="flex min-h-screen">

    {{-- ================= SIDEBAR ================= --}}
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

    {{-- ================= MAIN ================= --}}
    <main class="flex-1 flex flex-col bg-gray-100">

        {{-- ===== HEADER ===== --}}
        <header class="flex items-center justify-between px-8 py-4 bg-white border-b shadow-sm">

            {{-- Page Title --}}
            <div>
                <h1 class="text-xl font-semibold text-gray-900">
                    @yield('title')
                </h1>

                @hasSection('subtitle')
                    <p class="text-sm text-gray-500 mt-0.5">
                        @yield('subtitle')
                    </p>
                @endif
            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="inline-flex items-center gap-2
                           rounded-lg px-5 py-2
                           text-sm font-semibold
                           text-white
                           bg-red-500
                           hover:bg-red-600
                           active:bg-red-700
                           focus:outline-none focus:ring-2 focus:ring-red-400
                           transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-4 w-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17 16l4-4m0 0l-4-4m4 4H7" />
                    </svg>

                    Logout
                </button>
            </form>

        </header>

        {{-- ===== PAGE CONTENT ===== --}}
        <section class="p-8 flex-1">
            @yield('content')
        </section>

    </main>

</div>

</body>
</html>
