@extends('layouts.teacher')

@section('content')

{{-- ================= WELCOME HEADER ================= --}}
<div class="mb-8 rounded-3xl bg-gradient-to-r from-emerald-400 to-teal-300
            px-10 py-8 text-white shadow-xl">

    <h1 class="text-3xl font-bold">
        👋 Welcome, {{ auth()->user()->name }}
    </h1>

    <p class="mt-2 text-white/90 text-sm">
        Here are the modules assigned to you. You can view enrolled students
        and manage their progress.
    </p>
</div>

{{-- ================= MODULES SECTION ================= --}}
<h2 class="mb-4 text-xl font-bold text-gray-800">
    Assigned Modules
</h2>

@if($modules->isEmpty())
    <div class="rounded-xl bg-white p-6 shadow text-gray-500 italic">
        You are not assigned to any modules yet.
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($modules as $module)
            <div class="rounded-2xl border bg-white p-6 shadow hover:shadow-xl transition">

                <h3 class="text-lg font-bold text-gray-800">
                    {{ $module->module }}
                </h3>

                <p class="mt-1 text-sm text-gray-600">
                    Active students:
                    <span class="font-semibold">
                        {{ $module->activeStudentsCount ?? 0 }}
                    </span>
                </p>

                <a href="{{ route('teacher.modules.students', $module) }}"
                   class="mt-5 inline-block w-full rounded-xl
                          bg-gradient-to-r from-emerald-400 to-teal-300
                          py-2 text-center text-sm font-semibold text-white
                          hover:brightness-110 transition">
                    👥 View Students
                </a>

            </div>
        @endforeach

    </div>
@endif

@endsection
