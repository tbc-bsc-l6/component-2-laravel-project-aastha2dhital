<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-6 text-xl font-bold text-indigo-600">
            Admin Panel
        </div>

        <nav class="mt-6 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
            class="block px-6 py-3
            {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-indigo-50' }}">
            Dashboard
            </a>

            <a href="{{ route('admin.modules.index') }}"
            class="block px-6 py-3
            {{ request()->routeIs('admin.modules.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-indigo-50' }}">
             Modules
            </a>

            <a href="{{ route('admin.teachers') }}"
            class="block px-6 py-3
            {{ request()->routeIs('admin.teachers') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-indigo-50' }}">
             Teachers
            </a>

            <a href="{{ route('admin.students') }}"
            class="block px-6 py-3
            {{ request()->routeIs('admin.students') ? 'bg-indigo-100 text-indigo-700 font-semibold' : 'hover:bg-indigo-50' }}">
            Students
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1">

        <!-- TOPBAR -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold">
                @yield('header', 'Dashboard')
            </h1>

            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">
                    {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:underline">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <section class="p-6">
            @yield('content')
        </section>

    </main>

</div>

</body>
</html>
