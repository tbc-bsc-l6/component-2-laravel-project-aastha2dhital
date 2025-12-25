{{-- resources/views/components/teacher-layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Teacher Dashboard' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="min-h-screen">

    {{-- Top Navigation --}}
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <span class="text-xl font-bold text-indigo-600">🎓 Teacher</span>

            <a href="{{ route('teacher.modules.index') }}"
               class="text-sm text-gray-700 hover:underline">
                My Modules
            </a>
        </div>

        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-600">
                {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-red-600 hover:underline">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- Page Header --}}
    <header class="bg-white border-b px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $header ?? 'Teacher Dashboard' }}
        </h1>
    </header>

    {{-- Page Content --}}
    <main class="p-8">
        {{ $slot }}
    </main>

</div>
</body>
</html>
