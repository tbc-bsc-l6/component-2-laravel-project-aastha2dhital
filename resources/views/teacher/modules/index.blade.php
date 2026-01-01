@extends('layouts.teacher')

@section('content')

<!-- ================= PAGE TITLE ================= -->
<h2 class="mb-6 text-lg font-semibold text-slate-800">
    Assigned Modules
</h2>

<!-- ================= MODULE CARDS ================= -->
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

    @forelse($modules as $module)

        <div class="rounded-xl bg-white p-6 shadow-sm hover:shadow-md transition
                    border border-emerald-200">

            <!-- MODULE NAME -->
            <h3 class="text-base font-semibold text-slate-800">
                {{ $module->module }}
            </h3>

            <!-- ACTIVE STUDENTS -->
            <p class="mt-1 text-sm text-slate-600">
                Active students:
                <span class="font-semibold">
                    {{ $module->users()
                        ->wherePivotNull('completed_at')
                        ->count() }}
                </span>
            </p>

            <!-- ACTION -->
            <div class="mt-5">
                <a href="{{ route('teacher.modules.show', $module->id) }}"
                   class="inline-block w-full text-center rounded-full
                          px-4 py-2 text-sm font-semibold text-white
                          bg-gradient-to-r from-emerald-500 to-teal-400
                          hover:opacity-90 transition">
                    View Students
                </a>
            </div>

        </div>

    @empty
        <div class="col-span-full text-center text-slate-500">
            No modules assigned.
        </div>
    @endforelse

</div>

@endsection
