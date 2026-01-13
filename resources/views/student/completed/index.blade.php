@extends('layouts.student')

@section('title', 'Completed Courses')

@section('content')

{{-- HERO (matched gradient, no green) --}}
<div class="mb-8 rounded-2xl overflow-hidden shadow-xl
            bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-700 text-white">
    <div class="px-8 py-7">
        <h2 class="text-2xl font-extrabold tracking-tight">Completed Courses</h2>
        <p class="text-white/85 mt-1">Your PASS / FAIL history</p>
    </div>
</div>

{{-- SEARCH --}}
<form method="GET" action="{{ route('student.completed') }}" class="mb-6 max-w-md">
    <div class="relative">
        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Search completed modules..."
            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 pr-10
                   text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
        />
        <button class="absolute right-2 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800" type="submit">
            🔍
        </button>
    </div>
    @if(!empty($search))
        <div class="mt-2 text-xs text-slate-500">
            Showing results for: <span class="font-semibold text-slate-700">{{ $search }}</span>
            <a href="{{ route('student.completed') }}" class="ml-2 text-blue-600 hover:underline">Clear</a>
        </div>
    @endif
</form>

@if($completedModules->isEmpty())
    <div class="bg-white rounded-2xl p-6 shadow border border-slate-200 text-slate-600">
        <span class="font-semibold">No completed modules found.</span>
        @if(!empty($search))
            <div class="text-sm text-slate-500 mt-1">Try a different keyword.</div>
        @endif
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($completedModules as $module)
            @php
                $status = strtoupper($module->pivot->pass_status ?? 'COMPLETED');
                $isPass = $status === 'PASS';
            @endphp

            <div class="bg-white rounded-2xl shadow border border-slate-200 p-5">
                <h4 class="font-extrabold text-slate-900 text-base">
                    {{ $module->module }}
                </h4>

                <p class="text-sm text-slate-500 mt-1">
                    Completed on {{ \Carbon\Carbon::parse($module->pivot->completed_at)->format('d M Y') }}
                </p>

                <div class="mt-4">
                    <span class="inline-flex items-center gap-2 text-xs font-extrabold px-3 py-1 rounded-full
                        {{ $isPass ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-rose-50 text-rose-700 border border-rose-100' }}">
                        <span class="h-2 w-2 rounded-full {{ $isPass ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                        {{ $status }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
