<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-gray-100 flex flex-col">

        {{-- Logo --}}
        <div class="px-6 py-4 text-xl font-bold border-b border-gray-800 tracking-wide">
            Admin Panel
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 space-y-1">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded
               {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 font-medium' : 'hover:bg-gray-800' }}">
                Dashboard
            </a>

            <a href="{{ route('admin.modules.index') }}"
               class="block px-4 py-2 rounded
               {{ request()->routeIs('admin.modules.*') ? 'bg-gray-800 font-medium' : 'hover:bg-gray-800' }}">
                Modules
            </a>

            {{-- ✅ ENABLED --}}
            <a href="{{ route('admin.teachers.index') }}"
               class="block px-4 py-2 rounded
               {{ request()->routeIs('admin.teachers.*') ? 'bg-gray-800 font-medium' : 'hover:bg-gray-800' }}">
                Teachers
            </a>

            {{-- 🚧 Disabled until routes exist --}}
            <span class="block px-4 py-2 rounded text-gray-400 cursor-not-allowed">
                Students
            </span>

            <span class="block px-4 py-2 rounded text-gray-400 cursor-not-allowed">
                Old Students
            </span>

        </nav>

        {{-- User Info --}}
        <div class="px-6 py-4 border-t border-gray-800 text-sm">
            <p class="text-gray-400">Logged in as</p>
            <p class="font-medium">{{ auth()->user()->name }}</p>
        </div>

    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8">

        {{-- Top Header --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $header ?? 'Admin Dashboard' }}
                </h1>
                <p class="text-gray-500">
                    {{ $subheader ?? 'Manage system data and users' }}
                </p>
            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-red-600 hover:underline">
                    Logout
                </button>
            </form>
        </div>

        {{-- Page Content --}}
        {{ $slot }}

    </main>
</div>

</body>
</html>
