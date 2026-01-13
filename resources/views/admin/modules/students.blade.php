<x-admin-layout title="Module Students">

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Big fancy page header --}}
        <div class="card-strong p-10 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(34,211,238,.45) 0%, transparent 60%);"></div>

            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(99,102,241,.35) 0%, transparent 60%);"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                    Students — {{ $module->module }}
                </h1>
                <p class="text-slate-600 text-sm md:text-base mt-2 font-medium">
                    View enrolled students and pass / fail status
                </p>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-card overflow-hidden">
            <table class="w-full text-sm">
                <thead class="table-head">
                <tr>
                    <th class="px-6 py-4 text-left font-bold">Student</th>
                    <th class="px-6 py-4 text-left font-bold">Email</th>
                    <th class="px-6 py-4 text-left font-bold">Enrolled On</th>
                    <th class="px-6 py-4 text-left font-bold">Status</th>
                    <th class="px-6 py-4 text-left font-bold">Result</th>
                    <th class="px-6 py-4 text-right font-bold">Action</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-slate-200/70 bg-white/40">
                @forelse($students as $student)
                    <tr class="table-row align-top">

                        <td class="px-6 py-4 font-semibold text-slate-900">
                            {{ $student->name }}
                        </td>

                        <td class="px-6 py-4 text-slate-600 font-medium">
                            {{ $student->email }}
                        </td>

                        <td class="px-6 py-4 text-slate-600 font-medium">
                            {{ $student->pivot->enrolled_at
                                ? \Carbon\Carbon::parse($student->pivot->enrolled_at)->format('d M Y')
                                : '—' }}
                        </td>

                        {{-- ACTIVE / COMPLETED --}}
                        <td class="px-6 py-4">
                            @if($student->pivot->completed_at)
                                <span class="badge badge-archived">Completed</span>
                            @else
                                <span class="badge badge-warn">Active</span>
                            @endif
                        </td>

                        {{-- PASS / FAIL --}}
                        <td class="px-6 py-4">
                            @php
                                $status = strtolower((string)($student->pivot->pass_status ?? ''));
                            @endphp

                            @if($status === 'pass')
                                <span class="badge badge-active">Pass</span>
                            @elseif($status === 'fail')
                                <span class="badge badge-bad">Fail</span>
                            @else
                                <span class="badge badge-inactive">Pending</span>
                            @endif
                        </td>

                        {{-- REMOVE --}}
                        <td class="px-6 py-4 text-right">
                            <form method="POST"
                                  action="{{ route('admin.modules.students.remove', [$module, $student]) }}"
                                  onsubmit="return confirm('Remove this student from the module?')"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-rose-700 hover:underline font-semibold">
                                    Remove
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-slate-500 font-medium">
                            No students enrolled in this module.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>

    </div>

</x-admin-layout>
