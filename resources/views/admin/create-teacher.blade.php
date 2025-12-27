<x-admin-layout>
    <x-slot name="header">Create Teacher</x-slot>
    <x-slot name="subheader">Add a new teacher account</x-slot>

    <div class="max-w-xl bg-white rounded-xl shadow p-6">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.teachers.store') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Full Name
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full border rounded p-2"
                    required
                >
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email Address
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full border rounded p-2"
                    required
                >
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    class="w-full border rounded p-2"
                    required
                >
                <p class="text-xs text-gray-500 mt-1">
                    Minimum 8 characters
                </p>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-2">
                <a
                    href="{{ route('admin.teachers.index') }}"
                    class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-100">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Create Teacher
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
