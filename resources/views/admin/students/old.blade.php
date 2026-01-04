<x-admin-layout>

    {{-- HEADER --}}
    <div class="mb-8 rounded-3xl px-10 py-8
                bg-gradient-to-r from-emerald-400 to-teal-300
                text-white shadow-xl">
        <h1 class="text-3xl font-bold">🎓 Old Students</h1>
        <p class="text-white/90 text-sm">
            Students with completed modules (PASS / FAIL history)
        </p>
    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left">Student</th>
                    <th class="px-6 py-4 text-left">Completed Modules</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($students as $student)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium">
                            {{ $student->name }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="space-y-2">
                                @foreach($student->completedModules as $module)
                                    <div class="flex items-center gap-3">
                                        <span class="font-semibold">
                                            {{ $module->module }}
                                        </span>

                                        <span class="text-xs text-gray-500">
                                            Completed:
                                            {{ \Carbon\Carbon::parse($module->pivot->completed_at)->format('d M Y') }}
                                        </span>

                                        @if($module->pivot->pass_status === 'PASS')
                                            <span class="px-2 py-0.5 text-xs rounded-full bg-green-100 text-green-700">
                                                PASS
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-700">
                                                FAIL
                                            </span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
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
