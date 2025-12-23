<x-admin-layout>

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">
            Welcome, {{ auth()->user()->name }}
        </h1>
        <p class="text-gray-500 mt-1">
            Overview of system statistics
        </p>
    </div>

    {{-- Stats Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="bg-white rounded-lg shadow-sm p-5">
        <p class="text-sm text-gray-500">Total Modules</p>
        <p class="text-2xl font-semibold mt-1">12</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-5">
        <p class="text-sm text-gray-500">Teachers</p>
        <p class="text-2xl font-semibold mt-1">6</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-5">
        <p class="text-sm text-gray-500">Students</p>
        <p class="text-2xl font-semibold mt-1">128</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-5">
        <p class="text-sm text-gray-500">Active Modules</p>
        <p class="text-2xl font-semibold mt-1">9</p>
    </div>

</div>

</x-admin-layout>
