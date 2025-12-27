<x-teacher-layout>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-3 text-green-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header Card --}}
    <div class="mb-6 rounded-2xl bg-white p-6 shadow">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    {{ $module->module }}
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Assign PASS or FAIL to students. Graded students will appear
                    in their completed module history.
                </p>
            </div>

            {{-- Search --}}
            <form method="GET" class="w-full md:w-80">
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search student name..."
                        class="w-full rounded-xl border border-gray-300 pl-10 pr-4 py-2.5 text-sm
                               focus:border-indigo-500 focus:ring-indigo-500"
                    />
                </div>
            </form>
        </div>
    </div>

    {{-- Students Card --}}
    <div class="rounded-2xl bg-white shadow">
        @if ($students->isEmpty())
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-16 text-center">
                <div class="mb-4 text-4xl">📭</div>
                <h3 class="text-lg font-semibold text-gray-700">
                    No students found
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Try adjusting your search or check enrollments.
                </p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
                    <tr>
                        <th class="px-6 py-4 text-left">Student</th>
                        <th class="px-6 py-4 text-center">Result</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($students as $student)
                        @php
                            $status = strtolower($student->pivot->pass_status ?? '');
                        @endphp

                        <tr class="hover:bg-gray-50 transition">
                            {{-- Student --}}
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $student->name }}
                            </td>

                            {{-- Result --}}
                            <td class="px-6 py-4 text-center">
                                @if ($status === 'pass')
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                                 bg-green-100 text-green-700">
                                        PASS
                                    </span>
                                @elseif ($status === 'fail')
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                                 bg-red-100 text-red-700">
                                        FAIL
                                    </span>
                                @else
                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-500">
                                        Pending
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right">
                                @if ($status)
                                    {{-- Reset --}}
                                    <form method="POST"
                                          action="{{ route('teacher.modules.reset', [$module, $student]) }}"
                                          class="inline">
                                        @csrf
                                        <button
                                            class="rounded-lg bg-yellow-500 px-4 py-1.5 text-xs font-semibold
                                                   text-white shadow hover:bg-yellow-600 transition">
                                            Reset
                                        </button>
                                    </form>
                                @else
                                    {{-- Grade --}}
                                    <form method="POST"
                                          action="{{ route('teacher.modules.grade', [$module, $student]) }}"
                                          class="inline-flex gap-2">
                                        @csrf
                                        <button name="pass_status" value="pass"
                                            class="rounded-lg bg-green-600 px-4 py-1.5 text-xs
                                                   font-semibold text-white shadow hover:bg-green-700">
                                            PASS
                                        </button>

                                        <button name="pass_status" value="fail"
                                            class="rounded-lg bg-red-600 px-4 py-1.5 text-xs
                                                   font-semibold text-white shadow hover:bg-red-700">
                                            FAIL
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</x-teacher-layout>
