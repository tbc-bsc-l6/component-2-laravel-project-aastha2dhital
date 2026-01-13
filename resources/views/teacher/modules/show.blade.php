@extends('layouts.teacher')

@section('title', 'Module')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    <div class="card-strong p-10 relative overflow-hidden">
        <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full blur-3xl opacity-60"
             style="background: radial-gradient(circle, rgba(34,211,238,.45) 0%, transparent 60%);"></div>

        <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-60"
             style="background: radial-gradient(circle, rgba(99,102,241,.35) 0%, transparent 60%);"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                    {{ $module->module }}
                </h1>
                <p class="text-slate-600 mt-2 font-medium max-w-2xl">
                    Review student status for this module and mark students as pass / fail once completed.
                </p>
            </div>

            <a href="{{ route('teacher.modules.students', $module) }}" class="btn-brand">
                View Students →
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card p-6">
            <div class="text-sm text-slate-500 font-semibold">Active Students</div>
            <div class="text-3xl font-black text-slate-900 mt-1">{{ $activeCount }}</div>
        </div>
        <div class="card p-6">
            <div class="text-sm text-slate-500 font-semibold">Completed Students</div>
            <div class="text-3xl font-black text-slate-900 mt-1">{{ $completedCount }}</div>
        </div>
        <div class="card p-6">
            <div class="text-sm text-slate-500 font-semibold">Total Enrolled</div>
            <div class="text-3xl font-black text-slate-900 mt-1">{{ $activeCount + $completedCount }}</div>
        </div>
    </div>

</div>

@endsection
