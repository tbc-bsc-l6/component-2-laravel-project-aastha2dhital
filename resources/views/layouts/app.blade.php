<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Educational Admin System')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Top Navigation -->
    <header class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold tracking-wide">
                EduAdmin
            </h1>

            <nav class="space-x-6 text-sm font-medium">
                <a href="/admin" class="hover:text-blue-600">Dashboard</a>
                <a href="/admin/modules" class="hover:text-blue-600">Modules</a>
                <a href="/admin/teachers" class="hover:text-blue-600">Teachers</a>
                <a href="/student/dashboard" class="hover:text-blue-600">Student</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t bg-white">
        <div class="max-w-7xl mx-auto px-6 py-4 text-sm text-gray-500">
            © {{ date('Y') }} Educational Admin System
        </div>
    </footer>

</body>
</html>
