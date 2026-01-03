<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Old Students</h1>
        <p class="text-sm text-gray-500">
            Students who have completed all their enrolled modules
        </p>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-emerald-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                        Student
                    </th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                        Completed Modules
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($students as $student)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $student->name }}
                        </td>

                        <td class="px-6 py-4">
                            <ul class="list-disc pl-5 text-sm text-gray-700">
                                @foreach($student->completedModules as $module)
                                    <li>
                                        {{ $module->module }}
                                        <span class="ml-1 text-xs text-gray-500">
                                            ({{ $module->pivot->pass_status ?? 'N/A' }})
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-6 text-center text-gray-500">
                            No old students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
