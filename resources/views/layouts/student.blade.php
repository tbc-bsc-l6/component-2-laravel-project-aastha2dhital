<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">

<div class="min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-lg flex flex-col">

        {{-- Logo --}}
        <div class="p-6 text-xl font-bold text-indigo-600 border-b">
            🎓 Student Panel
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 space-y-1">

            {{-- Available Modules (students only) --}}
            @if(auth()->user()->role->role === 'student')
                <a href="{{ route('student.modules.index') }}"
                   class="block px-4 py-2 rounded
                   {{ request()->routeIs('student.modules.*')
                        ? 'bg-indigo-100 text-indigo-700 font-medium'
                        : 'hover:bg-indigo-50 text-gray-700' }}">
                    Available Modules
                </a>
            @endif

            {{-- Completed Modules (students + old students) --}}
            <a href="{{ route('student.history') }}"
               class="block px-4 py-2 rounded
               {{ request()->routeIs('student.history')
                    ? 'bg-indigo-100 text-indigo-700 font-medium'
                    : 'hover:bg-indigo-50 text-gray-700' }}">
                Completed Modules
            </a>

        </nav>

        {{-- User Info --}}
        <div class="px-6 py-4 border-t text-sm">
            <p class="text-gray-500">Logged in as</p>
            <p class="font-medium text-gray-800">
                {{ auth()->user()->name }}
            </p>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button class="w-full text-left text-red-600 hover:underline">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>
