@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="mb-10">
    <h2 class="text-3xl font-bold mb-2">Admin Dashboard</h2>
    <p class="text-gray-600">
        Manage modules, teachers, and student enrolments.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <a href="/admin/modules"
       class="bg-white border rounded-lg p-6 hover:shadow-md transition">
        <h3 class="text-lg font-semibold mb-2">Modules</h3>
        <p class="text-sm text-gray-600">
            Create modules, assign teachers, manage enrolments.
        </p>
    </a>

    <a href="/admin/teachers"
       class="bg-white border rounded-lg p-6 hover:shadow-md transition">
        <h3 class="text-lg font-semibold mb-2">Teachers</h3>
        <p class="text-sm text-gray-600">
            Add or remove teachers and manage roles.
        </p>
    </a>

    <a href="/student/dashboard"
       class="bg-white border rounded-lg p-6 hover:shadow-md transition">
        <h3 class="text-lg font-semibold mb-2">Students</h3>
        <p class="text-sm text-gray-600">
            View student enrolments and progress.
        </p>
    </a>

</div>

@endsection
