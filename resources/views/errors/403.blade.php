<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>403 – Access Denied</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center bg-slate-100">

    <div class="max-w-lg w-full bg-white shadow-xl rounded-2xl p-10 text-center">

        <div class="flex justify-center mb-5">
            <div class="h-16 w-16 rounded-full bg-red-100 text-red-600
                        flex items-center justify-center text-3xl font-bold">
                !
            </div>
        </div>

        <h1 class="text-2xl font-bold text-slate-800">
            403 – Access Denied
        </h1>

        <p class="mt-4 text-slate-600 text-sm leading-relaxed">
            You don’t have permission to access this page.
            This section is restricted based on your role.
        </p>

        <div class="mt-7">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center justify-center
                      px-6 py-2.5 rounded-lg
                      bg-indigo-600 text-white text-sm font-semibold
                      hover:bg-indigo-700 transition">
                Go back to dashboard
            </a>
        </div>

    </div>

</body>
</html>
