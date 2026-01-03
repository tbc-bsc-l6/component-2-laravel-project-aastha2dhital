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
                card.classList.remove(
                    'ring-2',
                    'ring-emerald-500',
                    'border-emerald-500'
                );
            });

            document.getElementById('role-' + role)
                .classList.add(
                    'ring-2',
                    'ring-emerald-500',
                    'border-emerald-500'
                );
        }
    </script>
</head>

<body class="min-h-screen relative overflow-hidden">

    <!-- ================= BACKGROUND IMAGE ================= -->
    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f');">
    </div>

    <!-- ================= GRADIENT OVERLAY ================= -->
    <div class="absolute inset-0 bg-gradient-to-br
                from-emerald-100/90 via-sky-100/90 to-indigo-100/90">
    </div>

    <!-- ================= PAGE CONTENT ================= -->
    <div class="relative min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md
                    bg-white/80 backdrop-blur-xl
                    rounded-3xl shadow-2xl
                    px-8 py-10">

            <!-- HEADER -->
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
                          bg-white hover:shadow-lg transition">

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full
                                    bg-gradient-to-br from-emerald-400 to-emerald-600
                                    flex items-center justify-center text-white text-xl">
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
                            px-5 py-4 bg-white
                            hover:shadow-lg transition">

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full
                                    bg-gradient-to-br from-sky-400 to-sky-600
                                    flex items-center justify-center text-white text-xl">
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
                            px-5 py-4 bg-white
                            hover:shadow-lg transition">

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full
                                    bg-gradient-to-br from-rose-400 to-rose-600
                                    flex items-center justify-center text-white text-xl">
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

                <!-- EMAIL -->
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
                                   bg-white/90
                                   focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>

                <!-- PASSWORD -->
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
                                   bg-white/90
                                   focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>

                <!-- LOGIN BUTTON -->
                <button
                    type="submit"
                    class="w-full rounded-xl py-3
                           bg-gradient-to-r from-emerald-500 to-teal-500
                           text-white font-semibold
                           shadow-lg hover:opacity-90 transition">
                    Login
                </button>
            </form>

            <!-- FOOTER -->
            <p class="text-xs text-center text-gray-400 mt-6">
                © {{ date('Y') }} Student Management System
            </p>

        </div>
    </div>

</body>
</html>
