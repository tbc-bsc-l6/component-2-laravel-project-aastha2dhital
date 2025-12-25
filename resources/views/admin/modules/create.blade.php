<x-admin-layout>
    <x-slot name="header">Create Module</x-slot>
    <x-slot name="subheader">Add a new academic module</x-slot>

    <div class="max-w-xl bg-white rounded-xl shadow p-6">
        <form method="POST" action="{{ route('admin.modules.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Module Name
                </label>
                <input
                type="text"
                name="module"
                value="{{ old('module') }}"
                class="w-full border rounded p-2"
                required
                >
            </div>
            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.modules.index') }}"
                   class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-100">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Create Module
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
