<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 antialiased">

<div class="min-h-screen flex">

    <!-- ================= SIDEBAR ================= -->
    <aside class="w-64 bg-gradient-to-b from-sky-600 via-sky-700 to-slate-900
                  text-white flex flex-col shadow-2xl">

        <!-- LOGO -->
        <div class="px-6 py-7 text-xl font-extrabold tracking-wide border-b border-white/20">
            🎓 Student Panel
        </div>

        <!-- NAV -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('student.modules.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold
                      hover:bg-white/15 transition
                      {{ request()->routeIs('student.modules.*') ? 'bg-white/20' : '' }}">
                📘 My Modules
            </a>

            <a href="{{ route('student.completed') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold
                      hover:bg-white/15 transition
                      {{ request()->routeIs('student.completed') ? 'bg-white/20' : '' }}">
                ✅ Completed Courses
            </a>
        </nav>

        <!-- LOGOUT -->
        <div class="p-4 border-t border-white/20">
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

    <!-- ================= MAIN CONTENT ================= -->
    <main class="flex-1 px-10 py-10 bg-[#F5F7FB]">
        {{ $slot }}
    </main>

</div>

</body>
</html>
