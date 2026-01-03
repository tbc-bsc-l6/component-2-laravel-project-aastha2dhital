<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Student Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        function selectRole(role) {
            document.getElementById('role').value = role;

            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('ring-2', 'ring-emerald-500', 'border-emerald-500');
            });

            document.getElementById('role-' + role)
                .classList.add('ring-2', 'ring-emerald-500', 'border-emerald-500');
        }
    </script>
</head>

<body class="min-h-screen flex items-center justify-center bg-slate-100 px-4">

<div class="w-full max-w-md bg-white rounded-3xl shadow-xl px-8 py-10">

    <!-- ================= HEADER ================= -->
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">
            Choose Account Type
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Select your role to continue
        </p>
    </div>

    <!-- ================= ROLE SELECTION ================= -->
    <div class="space-y-4 mb-8">

        <!-- STUDENT → REGISTER -->
        <a href="{{ route('register') }}"
           class="block rounded-xl border border-gray-200 px-5 py-4
                  hover:shadow-md transition cursor-pointer">

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-emerald-100
                            flex items-center justify-center text-emerald-600 text-xl">
                    🎓
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Student</p>
                    <p class="text-xs text-gray-500">
                        Enroll in modules & view results
                    </p>
                </div>
            </div>
        </a>

        <!-- TEACHER -->
        <div id="role-teacher"
             onclick="selectRole('teacher')"
             class="role-card cursor-pointer rounded-xl border border-gray-200
                    px-5 py-4 transition hover:shadow-md">

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-sky-100
                            flex items-center justify-center text-sky-600 text-xl">
                    📘
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Teacher</p>
                    <p class="text-xs text-gray-500">
                        Manage students & assign grades
                    </p>
                </div>
            </div>
        </div>

        <!-- ADMIN -->
        <div id="role-admin"
             onclick="selectRole('admin')"
             class="role-card cursor-pointer rounded-xl border border-gray-200
                    px-5 py-4 transition hover:shadow-md">

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-rose-100
                            flex items-center justify-center text-rose-600 text-xl">
                    🛠️
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Admin</p>
                    <p class="text-xs text-gray-500">
                        System & user management
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= LOGIN FORM ================= -->
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="role" id="role">

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Email
            </label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    📧
                </span>
                <input
                    type="email"
                    name="email"
                    required
                    class="w-full rounded-xl border border-gray-300
                           pl-10 pr-4 py-3 text-sm
                           focus:ring-2 focus:ring-emerald-500">
            </div>
        </div>

        <!-- Password -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Password
            </label>
            <div class="relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    🔒
                </span>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full rounded-xl border border-gray-300
                           pl-10 pr-4 py-3 text-sm
                           focus:ring-2 focus:ring-emerald-500">
            </div>
        </div>

        <!-- LOGIN BUTTON -->
        <button
            type="submit"
            class="w-full rounded-xl py-3 mt-4
                   bg-emerald-500 text-white font-semibold
                   hover:bg-emerald-600 transition">
            Login
        </button>
    </form>

    <!-- ================= FOOTER ================= -->
    <p class="text-xs text-center text-gray-400 mt-6">
        © {{ date('Y') }} Student Management System
    </p>

</div>

</body>
</html>
