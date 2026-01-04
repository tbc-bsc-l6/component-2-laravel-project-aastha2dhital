<x-teacher-layout>

    {{-- TOP GRADIENT HEADER (MATCH MODULES PAGE) --}}
    <div class="mb-8 rounded-3xl bg-gradient-to-r
                from-emerald-400 to-teal-300
                px-10 py-8 text-white shadow-xl">

        <h1 class="text-3xl font-bold flex items-center gap-2">
            👨‍🏫 {{ $module->module }}
        </h1>

        <p class="mt-2 text-white/90">
            Manage enrolled students and their results
        </p>
    </div>

    {{-- SECTION TITLE --}}
    <h2 class="mb-4 text-xl font-bold text-gray-800">
        Students Overview
    </h2>

    {{-- ACTIVE STUDENTS CARD --}}
    <div class="mb-8 rounded-2xl bg-white shadow-md">

        <div class="border-b px-6 py-4">
            <h3 class="font-semibold text-emerald-700">
                Active Students
            </h3>
        </div>

        <div class="p-6">
            @if($activeStudents->isEmpty())
                <p class="text-sm text-gray-500">
                    No active students.
                </p>
            @else
                <table class="w-full text-sm">
                    <thead class="border-b text-gray-600">
                        <tr>
                            <th class="pb-3 text-left">Name</th>
                            <th class="pb-3 text-left">Enrolled At</th>
                            <th class="pb-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeStudents as $student)
                            <tr class="border-b last:border-0">
                                <td class="py-4 font-medium">
                                    {{ $student->name }}
                                </td>
                                <td class="py-4 text-gray-500">
                                    {{ $student->pivot->enrolled_at }}
                                </td>
                                <td class="py-4 text-center">
                                    <form method="POST"
                                          action="{{ route('teacher.modules.grade', [$module, $student]) }}"
                                          class="inline-flex gap-3">
                                        @csrf
                                        <button
                                            name="pass_status"
                                            value="pass"
                                            class="rounded-full bg-emerald-500
                                                   px-4 py-1.5 text-sm
                                                   text-white hover:bg-emerald-600">
                                            PASS
                                        </button>
                                        <button
                                            name="pass_status"
                                            value="fail"
                                            class="rounded-full bg-rose-500
                                                   px-4 py-1.5 text-sm
                                                   text-white hover:bg-rose-600">
                                            FAIL
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- COMPLETED STUDENTS CARD --}}
    <div class="rounded-2xl bg-white shadow-md">

        <div class="border-b px-6 py-4">
            <h3 class="font-semibold text-gray-700">
                Completed Students
            </h3>
        </div>

        <div class="p-6">
            <table class="w-full text-sm">
                <thead class="border-b text-gray-600">
                    <tr>
                        <th class="pb-3 text-left">Name</th>
                        <th class="pb-3 text-left">Enrolled At</th>
                        <th class="pb-3 text-center">Result</th>
                        <th class="pb-3 text-center">Completed At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($completedStudents as $student)
                        <tr class="border-b last:border-0">
                            <td class="py-4 font-medium">
                                {{ $student->name }}
                            </td>
                            <td class="py-4 text-gray-500">
                                {{ $student->pivot->enrolled_at }}
                            </td>
                            <td class="py-4 text-center">
                                @if($student->pivot->pass_status === 'PASS')
                                    <span class="rounded-full bg-green-100
                                                 px-3 py-1 text-xs
                                                 font-semibold text-green-700">
                                        PASS
                                    </span>
                                @else
                                    <span class="rounded-full bg-red-100
                                                 px-3 py-1 text-xs
                                                 font-semibold text-red-700">
                                        FAIL
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 text-center text-gray-500">
                                {{ $student->pivot->completed_at }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</x-teacher-layout>
