<x-admin-layout>

    {{-- HEADER --}}
    <div class="mb-8 rounded-2xl bg-gradient-to-r from-emerald-400 to-teal-300 px-8 py-6 text-white shadow">
        <h1 class="text-2xl font-bold">
            👥 Students — {{ $module->module }}
        </h1>
        <p class="text-sm text-white/90">
            View enrolled students and pass / fail status
        </p>
    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow border">

        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">
                Enrolled Students
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left">Student</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Enrolled On</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Result</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($students as $student)
                        <tr class="hover:bg-slate-50">

                            <td class="px-6 py-4 font-medium">
                                {{ $student->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ $student->email }}
                            </td>

                            <td class="px-6 py-4 text-gray-600"> 
                                {{ $student->pivot->enrolled_at
                                    ? \Carbon\Carbon::parse($student->pivot->enrolled_at)->format('d M Y')
                                    : '—' }}
                            </td>


                            {{-- ACTIVE / COMPLETED --}}
                            <td class="px-6 py-4">
                                @if($student->pivot->completed_at)
                                    <span class="text-xs px-3 py-1 rounded-full bg-gray-200">
                                        Completed
                                    </span>
                                @else
                                    <span class="text-xs px-3 py-1 rounded-full bg-emerald-100 text-emerald-700">
                                        Active
                                    </span>
                                @endif
                            </td>

                            {{-- PASS / FAIL --}}
                            <td class="px-6 py-4">
                                @if($student->pivot->pass_status === 'pass')
                                    <span class="text-xs px-3 py-1 rounded-full bg-green-100 text-green-700">
                                        Pass
                                    </span>
                                @elseif($student->pivot->pass_status === 'fail')
                                    <span class="text-xs px-3 py-1 rounded-full bg-red-100 text-red-700">
                                        Fail
                                    </span>
                                @else
                                    <span class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>
                                @endif
                            </td>

                            {{-- REMOVE --}}
                            <td class="px-6 py-4 text-right">
                                <form method="POST"
                                      action="{{ route('admin.modules.students.remove', [$module, $student]) }}"
                                      onsubmit="return confirm('Remove this student from the module?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 font-semibold hover:underline">
                                        ❌ Remove
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                No students enrolled in this module.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>
