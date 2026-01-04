<x-admin-layout>

    {{-- HEADER --}}
    <div class="mb-6 rounded-3xl px-10 py-7
                bg-gradient-to-r from-emerald-400 to-teal-300
                text-white shadow-xl">
        <h1 class="text-2xl font-bold flex items-center gap-3">
            🎓 Students
        </h1>
        <p class="text-white/90 text-sm mt-1">
            Manage student accounts and enrollment status
        </p>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left w-48">Name</th>
                    <th class="px-6 py-3 text-left w-56">Email</th>
                    <th class="px-6 py-3 text-left">Enrollments</th>
                    <th class="px-6 py-3 text-left w-28">Role</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach($students as $student)
                    <tr class="hover:bg-slate-50 align-top">
                        {{-- NAME --}}
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $student->name }}
                        </td>

                        {{-- EMAIL --}}
                        <td class="px-6 py-4 text-gray-600">
                            {{ $student->email }}
                        </td>

                        {{-- ENROLLMENTS --}}
                        <td class="px-6 py-4">
                            @if($student->modules->isEmpty())
                                <span class="text-xs italic text-gray-400">
                                    Not enrolled in any module
                                </span>
                            @else
                                <div class="space-y-2">
                                    @foreach($student->modules as $module)
                                        <div class="flex items-center justify-between
                                                    rounded-lg border px-3 py-2
                                                    bg-slate-50">

                                            <div>
                                                <div class="font-medium text-gray-800">
                                                    {{ $module->module }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    Enrolled:
                                                    {{ \Carbon\Carbon::parse($module->pivot->enrolled_at)->format('d M Y') }}
                                                </div>
                                            </div>

                                            {{-- STATUS --}}
                                            <div class="shrink-0">
                                                @if(is_null($module->pivot->completed_at))
                                                    <span class="px-2 py-0.5 rounded-full
                                                                 bg-yellow-100 text-yellow-700
                                                                 text-xs font-semibold">
                                                        In Progress
                                                    </span>
                                                @elseif($module->pivot->pass_status)
                                                    <span class="px-2 py-0.5 rounded-full
                                                                 bg-green-100 text-green-700
                                                                 text-xs font-semibold">
                                                        PASS
                                                    </span>
                                                @else
                                                    <span class="px-2 py-0.5 rounded-full
                                                                 bg-red-100 text-red-700
                                                                 text-xs font-semibold">
                                                        FAIL
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </td>

                        {{-- ROLE --}}
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full
                                         bg-emerald-100 text-emerald-700
                                         text-xs font-semibold">
                                {{ ucfirst($student->role->role) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
