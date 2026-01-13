<x-admin-layout title="Students">

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Big fancy page header --}}
        <div class="card-strong p-10 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(34,211,238,.45) 0%, transparent 60%);"></div>

            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(99,102,241,.35) 0%, transparent 60%);"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                    Students
                </h1>
                <p class="text-slate-600 text-sm md:text-base mt-2 font-medium">
                    Manage student accounts and enrollment status
                </p>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-card overflow-hidden">
            <table class="w-full text-sm">
                <thead class="table-head">
                <tr>
                    <th class="px-6 py-4 text-left w-48 font-bold">Name</th>
                    <th class="px-6 py-4 text-left w-56 font-bold">Email</th>
                    <th class="px-6 py-4 text-left font-bold">Enrollments</th>
                    <th class="px-6 py-4 text-left w-64 font-bold">Role / Change Role</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-slate-200/70 bg-white/40">
                @forelse($students as $student)

                    @php
                        // A student has active modules if ANY module has completed_at = null
                        $hasActiveModules = $student->modules->contains(function ($module) {
                            return is_null($module->pivot->completed_at);
                        });
                    @endphp

                    <tr class="table-row align-top">
                        <td class="px-6 py-4 font-semibold text-slate-900">
                            {{ $student->name }}
                        </td>

                        <td class="px-6 py-4 text-slate-600 font-medium">
                            {{ $student->email }}
                        </td>

                        <td class="px-6 py-4">
                            @if($student->modules->isEmpty())
                                <span class="text-xs italic text-slate-400 font-medium">
                                    Not enrolled in any module
                                </span>
                            @else
                                <div class="space-y-3">
                                    @foreach($student->modules as $module)
                                        <div class="rounded-2xl border border-slate-200/70 bg-white/70 backdrop-blur
                                                    px-4 py-3 flex items-center justify-between shadow-sm">
                                            <div>
                                                <div class="font-semibold text-slate-900">
                                                    {{ $module->module }}
                                                </div>
                                                <div class="text-xs text-slate-500 font-medium">
                                                    Enrolled:
                                                    {{ \Carbon\Carbon::parse($module->pivot->enrolled_at)->format('d M Y') }}
                                                </div>
                                            </div>

                                            <div class="shrink-0">
                                                @if(is_null($module->pivot->completed_at))
                                                    <span class="badge badge-warn">In Progress</span>
                                                @elseif($module->pivot->pass_status)
                                                    <span class="badge badge-active">PASS</span>
                                                @else
                                                    <span class="badge badge-bad">FAIL</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </td>

                        {{-- ROLE CHANGE --}}
                        <td class="px-6 py-4">
                            <form method="POST"
                                  action="{{ route('admin.students.updateRole', $student) }}"
                                  class="flex items-center gap-3">
                                @csrf
                                @method('PATCH')

                                <select name="role"
                                        {{ $hasActiveModules ? 'disabled' : '' }}
                                        class="rounded-xl border px-3 py-1.5 text-sm
                                               focus:outline-none focus:ring-2 focus:ring-blue-400
                                               {{ $hasActiveModules
                                                   ? 'bg-slate-100 text-slate-400 cursor-not-allowed border-slate-200'
                                                   : 'border-slate-300'
                                               }}">
                                    <option value="student" {{ $student->user_role_id === 3 ? 'selected' : '' }}>
                                        Student
                                    </option>
                                    <option value="teacher" {{ $student->user_role_id === 2 ? 'selected' : '' }}>
                                        Teacher
                                    </option>
                                    <option value="old_student" {{ $student->user_role_id === 4 ? 'selected' : '' }}>
                                        Old Student
                                    </option>
                                </select>

                                <button type="submit"
                                        {{ $hasActiveModules ? 'disabled' : '' }}
                                        class="inline-flex items-center justify-center rounded-xl px-4 py-2 text-sm font-semibold
                                        {{ $hasActiveModules
                                            ? 'bg-slate-300 text-slate-500 cursor-not-allowed'
                                            : 'bg-indigo-600 text-white hover:bg-indigo-700 shadow-md shadow-indigo-500/30 border border-indigo-700'
                                        }}">
                                    Update
                                </button>
                            </form>

                            @if($hasActiveModules)
                                <div class="mt-1 text-xs text-slate-500">
                                    Cannot change role while active modules exist
                                </div>
                            @endif
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-slate-500 font-medium">
                            No students found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

</x-admin-layout>
