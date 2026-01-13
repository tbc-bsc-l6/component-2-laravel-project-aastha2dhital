@extends('layouts.teacher')

@section('title', 'My Assigned Modules')

@section('content')

{{-- FLASH --}}
@if(session('error'))
    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-red-700 font-semibold">
        ❌ {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-700 font-semibold">
        ✅ {{ session('success') }}
    </div>
@endif

{{-- HERO (IDENTICAL TO STUDENT) --}}
<div class="mb-8 rounded-2xl overflow-hidden shadow-xl
            bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-700 text-white">
    <div class="px-8 py-7">
        <h2 class="text-2xl font-extrabold tracking-tight">My Assigned Modules</h2>
        <p class="text-white/85 mt-1">
            View modules assigned by admin and manage enrolled students
        </p>
    </div>
</div>

{{-- ASSIGNED MODULES --}}
<div class="flex items-center justify-between mb-4">
    <h3 class="text-lg font-extrabold text-slate-800">Assigned Modules</h3>
    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-200 text-slate-700">
        Total: {{ $modules->count() }}
    </span>
</div>

@if($modules->isEmpty())
    <div class="bg-white rounded-2xl p-6 shadow border border-slate-200 text-slate-500">
        No modules have been assigned to you yet.
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($modules as $module)
            <div class="bg-white rounded-2xl shadow border border-slate-200 p-5 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 h-24 w-24 rounded-full bg-sky-100"></div>

                <div class="relative">
                    <h4 class="font-extrabold text-slate-900 text-base">
                        {{ $module->module }}
                    </h4>

                    <p class="text-sm text-slate-500 mt-1">
                        View active & completed students
                    </p>

                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xs text-slate-500">
                            Active:
                            {{ $module->students()
                                  ->wherePivotNull('completed_at')
                                  ->count() }}
                        </span>

                        <a href="{{ route('teacher.modules.students', $module) }}"
                           class="text-sm font-bold text-indigo-600 hover:underline">
                            Open →
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
