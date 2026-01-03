<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Student Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONT: INTER -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

<body class="min-h-screen relative overflow-hidden font-['Inter']">

    <!-- BACKGROUND IMAGE -->
    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f');">
    </div>

    <!-- GRADIENT OVERLAY -->
    <div class="absolute inset-0 bg-gradient-to-br
                from-emerald-200/95 via-sky-200/95 to-indigo-200/95">
    </div>

    <!-- PAGE CONTENT -->
    <div class="relative min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md
                    bg-white/85 backdrop-blur-xl
                    rounded-3xl shadow-2xl
                    px-8 py-10">

            <!-- HEADER -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">
                    Choose Account Type
                </h1>
                <p class="text-sm text-gray-600 mt-1">
                    Select your role to continue
                </p>
            </div>

            <!-- ROLE SELECTION -->
            <div class="space-y-4 mb-8">

                <!-- STUDENT -->
                <a href="{{ route('register') }}"
                   class="block rounded-xl border border-gray-200 px-5 py-4
                          bg-white hover:shadow-lg transition">

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full
                                    bg-gradient-to-br from-emerald-500 to-emerald-700
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
                            px-5 py-4 bg-white hover:shadow-lg transition">

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full
                                    bg-gradient-to-br from-sky-500 to-sky-700
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
                            px-5 py-4 bg-white hover:shadow-lg transition">

                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full
                                    bg-gradient-to-br from-rose-500 to-rose-700
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

            <!-- LOGIN FORM -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="role" id="role">

                <!-- EMAIL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        required
                        class="w-full rounded-xl border border-gray-300
                               px-4 py-3 text-sm bg-white
                               focus:ring-2 focus:ring-emerald-500">
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full rounded-xl border border-gray-300
                               px-4 py-3 text-sm bg-white
                               focus:ring-2 focus:ring-emerald-500">
                </div>

                <!-- LOGIN BUTTON -->
                <button
                    type="submit"
                    class="w-full mt-6 py-3 rounded-xl
                           bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-500
                           text-white font-semibold
                           shadow-2xl
                           ring-1 ring-black/10
                           border border-white/30
                           hover:from-emerald-700 hover:via-teal-600 hover:to-cyan-600
                           transition-all duration-300
                           overflow-hidden">
                    Login
                </button>
            </form>

            <!-- FOOTER -->
            <p class="text-xs text-center text-black-500 mt-6">
                © {{ date('Y') }} Student Management System
            </p>

        </div>
    </div>

</body>
</html>
