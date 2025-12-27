<x-admin-layout>
    <x-slot name="header">Create Module</x-slot>
    <x-slot name="subheader">Add a new academic module</x-slot>

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

        <form method="POST" action="{{ route('admin.modules.store') }}">
            @csrf

            {{-- Module Name --}}
            <div class="mb-4">
                <label
                    for="module"
                    class="block text-sm font-medium text-gray-700 mb-1">
                    Module Name
                </label>

                <input
                    type="text"
                    id="module"
                    name="module"
                    value="{{ old('module') }}"
                    placeholder="e.g. Web Application Development"
                    class="w-full border rounded p-2 focus:ring focus:ring-indigo-200"
                    required
                >
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-2">
                <a
                    href="{{ route('admin.modules.index') }}"
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
