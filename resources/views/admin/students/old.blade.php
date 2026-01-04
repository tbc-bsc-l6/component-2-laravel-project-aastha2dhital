<x-admin-layout>

    {{-- HEADER --}}
    <div class="mb-6 rounded-3xl px-10 py-7
                bg-gradient-to-r from-emerald-400 to-teal-300
                text-white shadow-xl">
        <h1 class="text-2xl font-bold flex items-center gap-3">
            🎓 Old Students
        </h1>
        <p class="text-white/90 text-sm mt-1">
            Students with completed modules (PASS / FAIL history)
        </p>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left w-48">Student</th>
                    <th class="px-6 py-3 text-left">Completed Module</th>
                    <th class="px-6 py-3 text-left w-40">Completion Date</th>
                    <th class="px-6 py-3 text-left w-28">Result</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($students as $student)
                    @php
                        $completed = $student->completedModules;
                        $count = $completed->count();
                    @endphp

                    @forelse($completed as $index => $module)
                        <tr class="hover:bg-slate-50">

                            {{-- STUDENT (ONLY ON FIRST ROW) --}}
                            @if($index === 0)
                                <td class="px-6 py-4 font-semibold text-gray-800 align-top"
                                    rowspan="{{ $count }}">
                                    {{ $student->name }}
                                </td>
                            @endif

                            {{-- MODULE --}}
                            <td class="px-6 py-4 text-gray-800">
                                {{ $module->module }}
                            </td>

                            {{-- DATE --}}
                            <td class="px-6 py-4 text-gray-600">
                                {{ \Carbon\Carbon::parse($module->pivot->completed_at)->format('d M Y') }}
                            </td>

                            {{-- RESULT --}}
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full
                                    {{ $module->pivot->pass_status === 'PASS'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}
                                    text-xs font-semibold">
                                    {{ $module->pivot->pass_status }}
                                </span>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-400 italic">
                                {{ $student->name }} has no completed modules
                            </td>
                        </tr>
                    @endforelse

                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-6 text-center text-gray-400 italic">
                            No old students found
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</x-admin-layout>
