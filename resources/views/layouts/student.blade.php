<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Student Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind / Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 antialiased">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 fixed inset-y-0 left-0
                  bg-gradient-to-b from-slate-900 to-slate-800
                  text-white shadow-lg">

        <!-- LOGO / TITLE -->
        <div class="h-16 flex items-center justify-center
                    font-bold text-lg border-b border-white/10">
            🎓 Student Panel
        </div>

        <!-- NAVIGATION -->
        <nav class="p-4 space-y-1 text-sm">

            <a href="{{ route('student.modules.index') }}"
               class="flex items-center gap-2 px-4 py-2 rounded-lg
               {{ request()->routeIs('student.modules.*')
                    ? 'bg-white/10 font-medium'
                    : 'hover:bg-white/5' }}">
                📘 <span>My Modules</span>
            </a>

            <a href="{{ route('student.completed') }}"
               class="flex items-center gap-2 px-4 py-2 rounded-lg
               {{ request()->routeIs('student.completed')
                    ? 'bg-white/10 font-medium'
                    : 'hover:bg-white/5' }}">
                ✅ <span>Completed Courses</span>
            </a>

        </nav>

        <!-- USER INFO + LOGOUT -->
        <div class="absolute bottom-0 w-full border-t border-white/10 p-4 text-xs">
            <div class="mb-2">
                Signed in as
                <div class="font-medium text-white">
                    {{ auth()->user()->name }}
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="w-full text-left text-red-400 hover:text-red-300 transition">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 ml-64 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>
