@extends('layouts.student')

@section('title', 'My Modules')

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

{{-- HERO --}}
<div class="mb-8 rounded-2xl overflow-hidden shadow-xl
            bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-700 text-white">
    <div class="px-8 py-7">
        <h2 class="text-2xl font-extrabold tracking-tight">My Modules</h2>
        <p class="text-white/85 mt-1">Manage your enrolled and available modules</p>
    </div>
</div>

{{-- ENROLLED --}}
<div class="flex items-center justify-between mb-4">
    <h3 class="text-lg font-extrabold text-slate-800">Enrolled Modules</h3>
    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-200 text-slate-700">
        Active: {{ $activeModules->count() }}/4
    </span>
</div>

@if($activeModules->isEmpty())
    <div class="bg-white rounded-2xl p-6 shadow border border-slate-200 text-slate-500">
        You are not enrolled in any modules.
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
        @foreach($activeModules as $module)
            <div class="bg-white rounded-2xl shadow border border-slate-200 p-5 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 h-24 w-24 rounded-full bg-sky-100"></div>

                <div class="relative">
                    <h4 class="font-extrabold text-slate-900 text-base">
                        {{ $module->module }}
                    </h4>

                    <p class="text-sm text-slate-500 mt-1">
                        Enrolled on {{ \Carbon\Carbon::parse($module->pivot->enrolled_at)->format('d M Y') }}
                    </p>

                    <span class="inline-flex items-center gap-2 mt-4 text-xs font-bold
                                 px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                        <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                        Active
                    </span>
                </div>
            </div>
        @endforeach
    </div>
@endif

{{-- AVAILABLE --}}
<h3 class="text-lg font-extrabold text-slate-800 mb-3">Available Modules</h3>

{{-- SEARCH --}}
<form method="GET" action="{{ route('student.modules.index') }}" class="mb-5 max-w-md">
    <div class="relative">
        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Search modules..."
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
            <a href="{{ route('student.modules.index') }}" class="ml-2 text-blue-600 hover:underline">Clear</a>
        </div>
    @endif
</form>

@if($availableModules->isEmpty())
    <div class="bg-white rounded-2xl p-6 shadow border border-slate-200 text-slate-600">
        <span class="font-semibold">Modules not available.</span>
        @if(!empty($search))
            <div class="text-sm text-slate-500 mt-1">Try a different keyword.</div>
        @endif
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($availableModules as $module)
            <div class="bg-white rounded-2xl shadow border border-slate-200 p-5 flex items-center justify-between">
                <div>
                    <h4 class="font-extrabold text-slate-900 text-base">
                        {{ $module->module }}
                    </h4>
                    <p class="text-xs text-slate-500 mt-1">Open for enrolment</p>
                </div>

                <form method="POST"
                      action="{{ route('student.modules.enrol', $module) }}"
                      class="enrol-form">
                    @csrf

                    <button
                        type="submit"
                        class="enrol-btn inline-flex items-center justify-center
                               rounded-full px-4 py-2 text-xs font-extrabold text-white
                               bg-gradient-to-r from-indigo-500 to-violet-600
                               hover:from-indigo-600 hover:to-violet-700
                               shadow-sm transition">
                        Enrol
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endif

{{-- POPUP if already 4 active --}}
<script>
    (function () {
        const activeCount = {{ (int) $activeModules->count() }};
        if (activeCount < 4) return;

        document.querySelectorAll('.enrol-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                alert("You can’t enrol in more than 4 active modules.");
            });
        });
    })();
</script>

@endsection
