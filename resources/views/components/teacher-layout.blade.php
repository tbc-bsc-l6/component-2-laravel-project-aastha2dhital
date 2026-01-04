<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR (FIXED, FULL HEIGHT) -->
    <aside class="fixed left-0 top-0 h-screen w-64">
        <div class="h-full p-4">
            <div class="flex h-full flex-col rounded-2xl
                        bg-gradient-to-b from-emerald-500 to-teal-400
                        p-4 shadow-xl">

                <!-- BRAND -->
                <div class="mb-6 flex items-center gap-2 text-white">
                    <span class="text-xl">🎓</span>
                    <span class="text-lg font-bold">Teacher Panel</span>
                </div>

                <!-- NAV -->
                <nav class="flex-1 space-y-2">
                    <a href="{{ route('teacher.modules.index') }}"
                       class="flex items-center gap-2 rounded-xl px-4 py-2
                              text-sm font-semibold
                              {{ request()->routeIs('teacher.modules.*')
                                    ? 'bg-white text-emerald-700'
                                    : 'text-white hover:bg-white/20' }}">
                        📘 My Modules
                    </a>
                </nav>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="mt-auto flex w-full items-center gap-2
                               rounded-xl bg-white/30 px-4 py-2
                               text-sm font-semibold text-emerald-900
                               hover:bg-white/50">
                        🚪 Logout
                    </button>
                </form>

            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT (SHIFTED RIGHT PROPERLY) -->
    <main class="ml-64 w-full p-8">
        {{ $slot }}
    </main>

</div>

</body>
</html>
