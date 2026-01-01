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

    <!-- ================= SIDEBAR ================= -->
    <aside class="w-64 text-white flex flex-col shadow-xl
                  bg-gradient-to-b from-emerald-400 to-teal-300">

        <!-- LOGO -->
        <div class="px-6 py-6 text-xl font-bold tracking-wide border-b border-white/30">
            🎓 Teacher Panel
        </div>

        <!-- NAV -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('teacher.modules.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold
                      hover:bg-white/20 transition
                      {{ request()->routeIs('teacher.modules.*') ? 'bg-white/25' : '' }}">
                📘 My Modules
            </a>
        </nav>

        <!-- LOGOUT -->
        <div class="p-4 border-t border-white/30">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="w-full text-left px-4 py-3 rounded-xl
                           bg-black/20 hover:bg-black/30 transition font-semibold">
                    🚪 Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ================= MAIN ================= -->
    <main class="flex-1 px-8 py-8">

        <!-- HEADER -->
        <div class="mb-8 rounded-2xl px-8 py-6
                    bg-gradient-to-r from-emerald-400 to-teal-300
                    text-white shadow-lg">
            <h1 class="text-2xl font-bold">
                👋 Hello, {{ auth()->user()->name }}
            </h1>
            <p class="text-white/90 mt-1">
                Manage your assigned modules and students
            </p>
        </div>

        @yield('content')

    </main>

</div>

</body>
</html>
