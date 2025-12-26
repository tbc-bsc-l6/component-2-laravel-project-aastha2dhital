<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-[Inter] bg-slate-100 text-slate-800">

    {{-- Top Bar --}}
    <div class="bg-white shadow p-4 flex justify-between">
        <h1 class="text-xl font-bold">Teacher Dashboard</h1>
        <div>{{ auth()->user()->name }}</div>
    </div>

    {{-- Page Content --}}
    <div class="p-6">
        @yield('content')
    </div>

</body>
</html>
