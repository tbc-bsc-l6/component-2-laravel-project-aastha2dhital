<x-admin-layout>

    {{-- HERO --}}
    <section class="mb-10 rounded-2xl bg-gradient-to-r from-emerald-400 to-teal-300
                    p-8 text-white shadow-xl">
        <h2 class="text-3xl font-bold">👋 Hello, {{ auth()->user()->name }}</h2>
        <p class="text-white/90 mt-1">
            Manage modules, teachers, students, and system operations
        </p>
    </section>

    {{-- STATS --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div class="bg-white rounded-xl p-6 shadow">
            <p class="text-sm text-gray-500">📘 Total Modules</p>
            <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $totalModules }}</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow">
            <p class="text-sm text-gray-500">👩‍🏫 Total Teachers</p>
            <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $totalTeachers }}</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow">
            <p class="text-sm text-gray-500">🎓 Active Students</p>
            <p class="text-3xl font-bold text-emerald-600 mt-2">{{ $totalStudents }}</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow">
            <p class="text-sm text-gray-500">✅ System Status</p>
            <p class="text-xl font-semibold text-green-600 mt-2">Operational</p>
        </div>

    </section>

    {{-- INFO --}}
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-6 shadow">
            <h3 class="font-semibold text-lg mb-1">📚 Module Management</h3>
            <p class="text-sm text-gray-500">Create, activate and assign modules.</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow">
            <h3 class="font-semibold text-lg mb-1">👥 User Management</h3>
            <p class="text-sm text-gray-500">Manage teachers, students and roles.</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow">
            <h3 class="font-semibold text-lg mb-1">📊 Academic Oversight</h3>
            <p class="text-sm text-gray-500">Monitor enrolments and completion.</p>
        </div>
    </section>

</x-admin-layout>
