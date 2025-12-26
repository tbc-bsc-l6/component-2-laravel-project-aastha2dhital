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

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-gray-100 flex flex-col">

        {{-- LOGO --}}
        <div class="px-6 py-4 text-xl font-bold border-b border-gray-800 tracking-wide">
            Admin Panel
        </div>

        {{-- NAVIGATION --}}
        <nav class="flex-1 px-2 py-6 space-y-1 text-sm">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-6 py-3 font-medium
               {{ request()->routeIs('admin.dashboard')
                    ? 'bg-white/10 text-white'
                    : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                Dashboard
            </a>

            {{-- Modules --}}
            <a href="{{ route('admin.modules.index') }}"
               class="flex items-center px-6 py-3 font-medium
               {{ request()->routeIs('admin.modules.*')
                    ? 'bg-white/10 text-white'
                    : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                Modules
            </a>

            {{-- Teachers --}}
            <a href="{{ route('admin.teachers.index') }}"
               class="flex items-center px-6 py-3 font-medium
               {{ request()->routeIs('admin.teachers.*')
                    ? 'bg-white/10 text-white'
                    : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                Teachers
            </a>

            {{-- Students --}}
            <a href="{{ route('admin.students.index') }}"
               class="flex items-center px-6 py-3 font-medium
               {{ request()->routeIs('admin.students.*')
                    ? 'bg-white/10 text-white'
                    : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                Students
            </a>

            {{-- Old Students --}}
            <a href="{{ route('admin.old-students.index') }}"
               class="flex items-center px-6 py-3 font-medium
               {{ request()->routeIs('admin.old-students.*')
                    ? 'bg-white/10 text-white'
                    : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                Old Students
            </a>

        </nav>

        {{-- USER INFO --}}
        <div class="px-6 py-4 border-t border-gray-800 text-sm">
            <p class="text-gray-400">Logged in as</p>
            <p class="font-medium text-white">
                {{ auth()->user()->name }}
            </p>
        </div>

    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-8">

        {{-- TOP HEADER --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $header ?? 'Admin Dashboard' }}
                </h1>
                <p class="text-gray-500">
                    {{ $subheader ?? 'Manage system data and users' }}
                </p>
            </div>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-red-600 hover:underline">
                    Logout
                </button>
            </form>
        </div>

        {{-- PAGE CONTENT --}}
        {{ $slot }}

    </main>

</div>

</body>
</html>
