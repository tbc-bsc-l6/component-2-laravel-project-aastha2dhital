<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 text-gray-100 flex flex-col">
        <div class="px-6 py-4 text-xl font-semibold border-b border-gray-700">
            Admin Panel
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-gray-800">
                Dashboard
            </a>

            <a href="#"
               class="block px-4 py-2 rounded hover:bg-gray-800">
                Modules
            </a>

            <a href="#"
               class="block px-4 py-2 rounded hover:bg-gray-800">
                Teachers
            </a>

            <a href="#"
               class="block px-4 py-2 rounded hover:bg-gray-800">
                Students
            </a>
        </nav>

        <div class="px-6 py-4 border-t border-gray-700 text-sm">
            Logged in as <br>
            <span class="font-medium">{{ auth()->user()->name }}</span>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-8">
        {{ $slot }}
    </main>

</div>
</body>
</html>
