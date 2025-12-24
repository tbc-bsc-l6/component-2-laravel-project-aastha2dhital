<x-admin-layout>
    <x-slot name="header">Admin Dashboard</x-slot>
    <x-slot name="subheader">Overview of system activity</x-slot>

    {{-- Welcome --}}
    <div class="mb-8">
        <p class="text-gray-600">
            Welcome back, <span class="font-medium text-gray-800">{{ auth()->user()->name }}</span>.
        </p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Modules --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Total Modules</p>
            <p class="mt-2 text-3xl font-bold text-gray-800">
                {{ $totalModules ?? 0 }}
            </p>
        </div>

        {{-- Teachers --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Total Teachers</p>
            <p class="mt-2 text-3xl font-bold text-gray-800">
                {{ $totalTeachers ?? 0 }}
            </p>
        </div>

        {{-- Students --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm text-gray-500">Total Students</p>
            <p class="mt-2 text-3xl font-bold text-gray-800">
                {{ $totalStudents ?? 0 }}
            </p>
        </div>

    </div>

    {{-- Footer hint --}}
    <div class="mt-10 text-sm text-gray-400">
        Use the sidebar to manage modules, teachers, and students.
    </div>
</x-admin-layout>
