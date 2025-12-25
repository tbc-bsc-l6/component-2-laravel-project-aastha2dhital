<x-admin-layout>
    <x-slot name="header">
        Assign Teachers
    </x-slot>

    <div class="max-w-xl bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">
            Module: {{ $module->module }}
        </h2>

        <form method="POST"
              action="{{ route('admin.modules.assign-teacher', $module) }}">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                @forelse($teachers as $teacher)
                    <label class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="teachers[]"
                            value="{{ $teacher->id }}"
                            @checked($module->teachers->contains($teacher))
                        >
                        {{ $teacher->name }} ({{ $teacher->email }})
                    </label>
                @empty
                    <p class="text-gray-500">
                        No teachers available.
                    </p>
                @endforelse
            </div>

            <div class="mt-6">
                <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
