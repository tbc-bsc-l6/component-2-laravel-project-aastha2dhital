<x-admin-layout>
    <x-slot name="header">Dashboard</x-slot>
    <x-slot name="subheader">Administrative control & system overview</x-slot>

    {{-- HERO / INTRO --}}
    <section class="relative mb-12 overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-700 via-blue-600 to-sky-500 p-8 text-white shadow-xl">
        <div class="relative z-10 max-w-2xl">
            <h2 class="text-3xl font-bold tracking-tight">
                Welcome back, {{ auth()->user()->name }}
            </h2>
            <p class="mt-2 text-indigo-100">
                Monitor academic operations, manage users, and control system access from one centralized dashboard.
            </p>
        </div>

        {{-- Decorative background shapes --}}
        <div class="absolute -top-16 -right-16 w-72 h-72 bg-white/10 rounded-full"></div>
        <div class="absolute bottom-10 right-40 w-32 h-32 bg-white/10 rounded-full"></div>
    </section>

    {{-- PRIMARY STATS --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">

        {{-- Modules --}}
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Modules</p>
                    <p class="mt-2 text-3xl font-bold text-indigo-600">
                        {{ $totalModules ?? 0 }}
                    </p>
                </div>
                <div class="p-3 rounded-lg bg-indigo-100">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Teachers --}}
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Teachers</p>
                    <p class="mt-2 text-3xl font-bold text-emerald-600">
                        {{ $totalTeachers ?? 0 }}
                    </p>
                </div>
                <div class="p-3 rounded-lg bg-emerald-100">
                    <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2"
                              d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Students --}}
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Active Students</p>
                    <p class="mt-2 text-3xl font-bold text-sky-600">
                        {{ $totalStudents ?? 0 }}
                    </p>
                </div>
                <div class="p-3 rounded-lg bg-sky-100">
                    <svg class="h-6 w-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2"
                              d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-width="2"
                              d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- System Status --}}
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">System Status</p>
                    <p class="mt-2 text-xl font-semibold text-green-600">
                        Operational
                    </p>
                </div>
                <div class="p-3 rounded-lg bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2"
                              d="M9 12l2 2 4-4"/>
                        <circle cx="12" cy="12" r="9" stroke-width="2"/>
                    </svg>
                </div>
            </div>
        </div>

    </section>

    {{-- MANAGEMENT SECTIONS --}}
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">

        {{-- Module Management --}}
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Module Management</h3>
            <p class="text-sm text-gray-500">
                Create, activate, deactivate, and assign teachers to academic modules.
            </p>
        </div>

        {{-- User Management --}}
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">User Management</h3>
            <p class="text-sm text-gray-500">
                Manage teachers, students, old students, and control user roles.
            </p>
        </div>

        {{-- Academic Oversight --}}
        <div class="bg-white rounded-xl p-6 shadow-sm border">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Academic Oversight</h3>
            <p class="text-sm text-gray-500">
                Monitor enrolments, grading status, and completion outcomes.
            </p>
        </div>

    </section>

    {{-- FOOTER NOTE --}}
    <p class="text-xs text-gray-400">
        Dashboard reflects real-time system data. Designed for administrative clarity and control.
    </p>
</x-admin-layout>
