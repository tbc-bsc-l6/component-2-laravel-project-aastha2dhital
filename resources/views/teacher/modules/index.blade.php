{{-- resources/views/teacher/modules/index.blade.php --}}
<x-teacher-layout>
    <x-slot name="header">My Modules</x-slot>

    @if ($modules->isEmpty())
        <div class="mt-10 text-center text-gray-500">
            You have no modules assigned yet.
        </div>
    @else
        <div class="mt-6 bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 text-left">Module</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($modules as $module)
                        <tr>
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $module->module }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('teacher.modules.show', $module) }}"
                                   class="text-indigo-600 hover:underline">
                                    View Students
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-teacher-layout>
