<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            {{ $module->name }} — Enrolled Students
        </h2>
    </x-slot>

    <div class="p-6">
        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">Student</th>
                    <th class="p-2 text-center">Enrolled</th>
                    <th class="p-2 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr class="border-t">
                        <td class="p-2">{{ $student->name }}</td>
                        <td class="p-2 text-center">
                            {{ optional($student->pivot->enrolled_at)->format('Y-m-d') }}
                        </td>
                        <td class="p-2 text-center">
                            {{ $student->pivot->pass_status ?? 'IN PROGRESS' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            No students enrolled.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
