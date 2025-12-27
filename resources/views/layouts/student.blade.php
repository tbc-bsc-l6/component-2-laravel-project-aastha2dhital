<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow">
        <div class="p-6 font-bold text-indigo-600">
            🎓 Student Panel
        </div>

        <nav class="px-4 space-y-2">
            <a href="{{ route('student.modules.index') }}"
               class="block px-4 py-2 rounded hover:bg-indigo-100">
                Available Modules
            </a>

            <a href="{{ route('student.history') }}"
               class="block px-4 py-2 rounded hover:bg-indigo-100">
                Completed Modules
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100 rounded">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</div>

</body>
</html>
