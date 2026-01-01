<x-student-layout>

    <h2 class="text-2xl font-bold text-slate-800 mb-6">
        Completed Modules History
    </h2>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-slate-100">
                <tr>
                    <th class="p-3 text-left">Module</th>
                    <th class="p-3 text-left">Code</th>
                    <th class="p-3 text-left">Result</th>
                    <th class="p-3 text-left">Completed On</th>
                </tr>
            </thead>

            <tbody>
                @forelse($completedModules as $module)
                    <tr class="border-t">
                        <td class="p-3">{{ $module->name }}</td>
                        <td class="p-3">{{ $module->code }}</td>

                        <td class="p-3 font-semibold
                            {{ $module->pass_status === 'pass'
                                ? 'text-green-600'
                                : 'text-red-600' }}">
                            {{ strtoupper($module->pass_status) }}
                        </td>

                        <td class="p-3">
                            {{ \Carbon\Carbon::parse($module->completed_at)->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-slate-500">
                            No completed modules found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</x-student-layout>
