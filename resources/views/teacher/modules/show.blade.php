@extends('layouts.teacher')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="mb-6 rounded-2xl px-8 py-6
            bg-gradient-to-r from-emerald-400 via-teal-400 to-green-400
            text-white shadow-lg">

    <h2 class="text-xl font-bold flex items-center gap-2">
        📘 {{ $module->module }}
    </h2>

    <p class="text-white/90">
        Manage enrolled students and assign results
    </p>
</div>

{{-- ================= SEARCH ================= --}}
<form method="GET" class="mb-6 flex gap-3 max-w-md">
    <input
        type="text"
        name="search"
        value="{{ $search ?? '' }}"
        placeholder="Search student..."
        class="flex-1 rounded-lg border border-slate-300
               px-4 py-2 text-sm
               focus:ring-2 focus:ring-emerald-400">

    <button
        type="submit"
        class="rounded-lg px-5 py-2 text-sm font-semibold
               bg-emerald-600 text-white
               hover:bg-emerald-700 shadow">
        Search
    </button>
</form>

{{-- ================= ACTIVE STUDENTS ================= --}}
<div class="bg-white rounded-xl shadow border mb-10 p-6">

    <h2 class="text-lg font-bold mb-4 text-slate-800">
        Active Students
    </h2>

    @if($students->isEmpty())
        <p class="text-slate-500">
            No active students in this module.
        </p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b text-slate-600">
                    <tr class="text-left">
                        <th class="py-3">Student</th>
                        <th>Email</th>
                        <th>Enrolled On</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                @foreach($students as $student)
                    <tr>
                        <td class="py-3 font-medium text-slate-800">
                            {{ $student->name }}
                        </td>

                        <td class="text-slate-600">
                            {{ $student->email }}
                        </td>

                        <td class="text-slate-600">
                            {{ \Carbon\Carbon::parse($student->pivot->created_at)->format('d M Y') }}
                        </td>

                        <td class="py-3">
                            <div class="flex justify-end gap-2">

                                {{-- PASS --}}
                                <form method="POST"
                                      action="{{ route('teacher.modules.grade', [$module->id, $student->id]) }}">
                                    @csrf
                                    <input type="hidden" name="pass_status" value="pass">
                                    <button
                                        type="submit"
                                        class="min-w-[70px] rounded-md px-3 py-1
                                               text-xs font-semibold
                                               bg-emerald-600 text-white
                                               hover:bg-emerald-700 shadow">
                                        PASS
                                    </button>
                                </form>

                                {{-- FAIL --}}
                                <form method="POST"
                                      action="{{ route('teacher.modules.grade', [$module->id, $student->id]) }}">
                                    @csrf
                                    <input type="hidden" name="pass_status" value="fail">
                                    <button
                                        type="submit"
                                        class="min-w-[70px] rounded-md px-3 py-1
                                               text-xs font-semibold
                                               bg-red-500 text-white
                                               hover:bg-red-600 shadow">
                                        FAIL
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- ================= COMPLETED STUDENTS ================= --}}
<div class="bg-white rounded-xl shadow border p-6">

    <h2 class="text-lg font-bold mb-4 text-slate-800">
        Completed Students
    </h2>

    @php
        $completed = $module->users()
            ->wherePivotNotNull('completed_at')
            ->withPivot(['pass_status', 'completed_at'])
            ->get();
    @endphp

    @if($completed->isEmpty())
        <p class="text-slate-500">
            No completed students yet.
        </p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b text-slate-600">
                    <tr class="text-left">
                        <th class="py-3">Student</th>
                        <th>Result</th>
                        <th>Completed On</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                @foreach($completed as $student)
                    <tr>
                        <td class="py-3 font-medium text-slate-800">
                            {{ $student->name }}
                        </td>

                        <td>
                            <span class="rounded-full px-3 py-1 text-xs font-semibold
                                {{ $student->pivot->pass_status === 'pass'
                                    ? 'bg-emerald-100 text-emerald-700'
                                    : 'bg-red-100 text-red-700' }}">
                                {{ strtoupper($student->pivot->pass_status) }}
                            </span>
                        </td>

                        <td class="text-slate-600">
                            {{ \Carbon\Carbon::parse($student->pivot->completed_at)->format('d M Y') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
