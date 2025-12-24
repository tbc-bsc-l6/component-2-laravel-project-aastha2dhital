<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">My Modules</h2>
    </x-slot>

    <div class="p-6 space-y-4">
        @forelse($modules as $module)
            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold">{{ $module->name }}</h3>

                <a href="{{ route('teacher.modules.show', $module) }}"
                   class="text-indigo-600 underline">
                    View Students
                </a>
            </div>
        @empty
            <p class="text-gray-500">No modules assigned yet.</p>
        @endforelse
    </div>
</x-app-layout>
