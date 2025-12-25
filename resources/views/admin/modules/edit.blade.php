<x-admin-layout>
    <x-slot name="header">Assign Teachers</x-slot>

    <div class="p-6 bg-white rounded-lg shadow max-w-xl">
        <form method="POST" action="{{ route('admin.modules.update', $module) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">
                    Module
                </label>
                <p class="mt-1 text-gray-900">
                    {{ $module->module }}
                </p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Assign Teachers
                </label>

                @forelse($teachers as $teacher)
                    <label class="flex items-center gap-2 mb-2">
                        <input type="checkbox"
                               name="teachers[]"
                               value="{{ $teacher->id }}"
                               {{ $module->teachers->contains($teacher->id) ? 'checked' : '' }}>
                        <span>{{ $teacher->name }} ({{ $teacher->email }})</span>
                    </label>
                @empty
                    <p class="text-sm text-gray-500">
                        No teachers found. Create a teacher first.
                    </p>
                @endforelse
            </div>

            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Save
            </button>
        </form>
    </div>
</x-admin-layout>
