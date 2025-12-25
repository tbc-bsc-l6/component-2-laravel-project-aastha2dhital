<x-admin-layout>
    <x-slot name="header">Create Teacher</x-slot>

    <div class="max-w-md bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('admin.teachers.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium">Password</label>
                <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
            </div>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Create Teacher
            </button>
        </form>
    </div>
</x-admin-layout>
