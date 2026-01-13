@extends('layouts.teacher')

@section('title', $module->module . ' - Students')

@section('content')

{{-- HERO --}}
<div class="mb-8 rounded-2xl overflow-hidden shadow-xl
            bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-700 text-white">
    <div class="px-8 py-7 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight">
                {{ $module->module }}
            </h2>
            <p class="text-white/85 mt-1">
                Manage students enrolled in this module. Mark pass or fail once completed.
            </p>
        </div>

        <a href="{{ route('teacher.modules.index') }}"
           class="rounded-full bg-white/20 hover:bg-white/30
                  px-4 py-2 text-sm font-bold transition">
            ← Back to Modules
        </a>
    </div>
</div>

{{-- ACTIVE STUDENTS --}}
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-extrabold text-slate-800">Active Students</h3>
        <span class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-200 text-slate-700">
            {{ $activeStudents->count() }} student(s)
        </span>
    </div>

    @if($activeStudents->isEmpty())
        <div class="bg-white rounded-2xl p-6 shadow border border-slate-200 text-slate-500">
            No active students in this module.
        </div>
    @else
        <div class="bg-white rounded-2xl shadow border border-slate-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-5 py-3 text-left">Student</th>
                        <th class="px-5 py-3 text-left">Enrolled At</th>
                        <th class="px-5 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($activeStudents as $student)
                    <tr class="border-t border-slate-100" x-data="{ disabled: false }">
                        <td class="px-5 py-4 font-semibold text-slate-800">
                            {{ $student->name }}
                        </td>
                        <td class="px-5 py-4 text-slate-500">
                            {{ \Carbon\Carbon::parse($student->pivot->enrolled_at)->format('d M Y, H:i') }}
                        </td>
                        <td class="px-5 py-4 text-right space-x-2">

                            {{-- PASS --}}
                            <form method="POST"
                                  action="{{ route('teacher.modules.grade', [$module, $student]) }}"
                                  class="inline"
                                  @submit="disabled = true">
                                @csrf
                                <input type="hidden" name="result" value="pass">
                                <button
                                    :disabled="disabled"
                                    class="rounded-full px-4 py-1.5 text-xs font-extrabold text-white
                                           bg-emerald-500 hover:bg-emerald-600 transition
                                           disabled:opacity-50 disabled:cursor-not-allowed">
                                    PASS
                                </button>
                            </form>

                            {{-- FAIL --}}
                            <form method="POST"
                                  action="{{ route('teacher.modules.grade', [$module, $student]) }}"
                                  class="inline"
                                  @submit="disabled = true">
                                @csrf
                                <input type="hidden" name="result" value="fail">
                                <button
                                    :disabled="disabled"
                                    class="rounded-full px-4 py-1.5 text-xs font-extrabold text-white
                                           bg-rose-500 hover:bg-rose-600 transition
                                           disabled:opacity-50 disabled:cursor-not-allowed">
                                    FAIL
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- COMPLETED STUDENTS --}}
<div>
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-extrabold text-slate-800">Completed Students</h3>
        <span class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-200 text-slate-700">
            {{ $completedStudents->count() }} student(s)
        </span>
    </div>

    @if($completedStudents->isEmpty())
        <div class="bg-white rounded-2xl p-6 shadow border border-slate-200 text-slate-500">
            No completed students yet.
        </div>
    @else
        <div class="bg-white rounded-2xl shadow border border-slate-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="px-5 py-3 text-left">Student</th>
                        <th class="px-5 py-3 text-left">Result</th>
                        <th class="px-5 py-3 text-left">Completed At</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($completedStudents as $student)
                    <tr class="border-t border-slate-100">
                        <td class="px-5 py-4 font-semibold text-slate-800">
                            {{ $student->name }}
                        </td>
                        <td class="px-5 py-4">
                            @if($student->pivot->pass_status === 'PASS')
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold
                                             bg-emerald-100 text-emerald-700">
                                    PASS
                                </span>
                            @else
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold
                                             bg-rose-100 text-rose-700">
                                    FAIL
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-slate-500">
                            {{ \Carbon\Carbon::parse($student->pivot->completed_at)->format('d M Y, H:i') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@endsection
