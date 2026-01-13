<x-admin-layout title="Old Students">

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Big fancy page header --}}
        <div class="card-strong p-10 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(34,211,238,.45) 0%, transparent 60%);"></div>

            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(99,102,241,.35) 0%, transparent 60%);"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">Old Students</h1>
                <p class="text-slate-600 text-sm md:text-base mt-2 font-medium">
                    Students with completed modules (PASS / FAIL history)
                </p>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-card overflow-hidden">
            <table class="w-full text-sm">
                <thead class="table-head">
                <tr>
                    <th class="px-6 py-4 text-left w-48 font-bold">Student</th>
                    <th class="px-6 py-4 text-left font-bold">Completed Module</th>
                    <th class="px-6 py-4 text-left w-40 font-bold">Completion Date</th>
                    <th class="px-6 py-4 text-left w-28 font-bold">Result</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-slate-200/70 bg-white/40">
                @forelse($students as $student)
                    @php
                        $completed = $student->completedModules;
                        $count = $completed->count();
                    @endphp

                    @forelse($completed as $index => $module)
                        <tr class="table-row">
                            @if($index === 0)
                                <td class="px-6 py-4 font-semibold text-slate-900 align-top" rowspan="{{ $count }}">
                                    {{ $student->name }}
                                </td>
                            @endif

                            <td class="px-6 py-4 text-slate-900 font-medium">{{ $module->module }}</td>

                            <td class="px-6 py-4 text-slate-600 font-medium">
                                {{ \Carbon\Carbon::parse($module->pivot->completed_at)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                @if($module->pivot->pass_status === 'PASS')
                                    <span class="badge badge-active">PASS</span>
                                @else
                                    <span class="badge badge-bad">FAIL</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-500 italic font-medium">
                                {{ $student->name }} has no completed modules
                            </td>
                        </tr>
                    @endforelse

                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-500 italic font-medium">
                            No old students found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

</x-admin-layout>
