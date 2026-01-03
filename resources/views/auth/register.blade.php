<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Student Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    Student Registration
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Create your student account to get started
                </p>
            </div>

            <!-- ================= REGISTER FORM ================= -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- NAME -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Full Name
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            👤
                        </span>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="w-full rounded-xl border border-gray-300
                                   pl-10 pr-4 py-3 text-sm
                                   bg-white/90
                                   focus:ring-2 focus:ring-emerald-500">
                    </div>
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

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
                            value="{{ old('email') }}"
                            required
                            class="w-full rounded-xl border border-gray-300
                                   pl-10 pr-4 py-3 text-sm
                                   bg-white/90
                                   focus:ring-2 focus:ring-emerald-500">
                    </div>
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
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
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- CONFIRM PASSWORD -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                            🔐
                        </span>
                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            class="w-full rounded-xl border border-gray-300
                                   pl-10 pr-4 py-3 text-sm
                                   bg-white/90
                                   focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>

                <!-- REGISTER BUTTON -->
                <button
                    type="submit"
                    class="w-full rounded-xl py-3
                           bg-gradient-to-r from-emerald-500 to-teal-500
                           text-white font-semibold
                           shadow-lg hover:opacity-90 transition">
                    Create Account
                </button>
            </form>

            <!-- FOOTER LINKS -->
            <p class="text-sm text-center text-gray-500 mt-6">
                Already have an account?
                <a href="{{ route('login') }}"
                   class="text-emerald-600 font-medium hover:underline">
                    Login here
                </a>
            </p>

            <p class="text-xs text-center text-gray-400 mt-4">
                © {{ date('Y') }} Student Management System
            </p>

        </div>
    </div>

</body>
</html>
