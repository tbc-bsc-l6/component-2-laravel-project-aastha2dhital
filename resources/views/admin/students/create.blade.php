@extends('layouts.admin')

@section('title', 'Create Student')
@section('header', 'Create Student')

@section('content')

{{-- Page Intro --}}
<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800">
        Add New Student
    </h2>
    <p class="text-sm text-gray-500 mt-1">
        Create a student account and assign login credentials
    </p>
</div>

{{-- Validation Errors --}}
@if ($errors->any())
    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
        <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Form Card --}}
<div class="max-w-xl bg-white rounded-xl shadow p-6">

    <form method="POST" action="{{ route('admin.students.store') }}" class="space-y-6">
        @csrf

        {{-- Name --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Full Name
            </label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="Enter student name"
                required
            >
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Email Address
            </label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="student@example.com"
                required
            >
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Password
            </label>
            <input
                type="password"
                name="password"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                required
            >
        </div>

        {{-- Confirm Password --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Confirm Password
            </label>
            <input
                type="password"
                name="password_confirmation"
                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                required
            >
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between pt-4">
            <a
                href="{{ route('admin.students.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900"
            >
                ← Back to Students
            </a>

            <button
                type="submit"
                class="inline-flex items-center px-5 py-2.5 rounded-lg
                       bg-indigo-600 text-white text-sm font-medium
                       hover:bg-indigo-700 transition"
            >
                Create Student
            </button>
        </div>

    </form>
</div>

@endsection
