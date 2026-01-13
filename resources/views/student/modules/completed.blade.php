<x-student-layout>

    {{-- ================= PAGE HEADER ================= --}}
    <div class="card-strong p-8 mb-8">
        <h1 class="text-2xl font-black text-slate-900 tracking-tight">
            Completed Courses
        </h1>
        <p class="text-sm text-slate-600 font-medium mt-1">
            View your completed modules and final results
        </p>
    </div>

    {{-- ================= CONTENT ================= --}}
    @if($completedModules->isEmpty())
        <div class="rounded-2xl bg-white p-8 text-center
                    border border-slate-200/70 shadow-sm">
            <p class="text-sm text-slate-500 font-medium">
                You have not completed any courses yet.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($completedModules as $module)
                <div class="rounded-2xl bg-white p-5
                            border border-slate-200/70
                            shadow-sm hover:shadow-md transition">

                    {{-- MODULE NAME --}}
                    <div class="font-semibold text-slate-900">
                        {{ $module->module }}
                    </div>

                    {{-- COMPLETION DATE --}}
                    <div class="mt-1 text-xs text-slate-500 font-medium">
                        Completed:
                        {{ \Carbon\Carbon::parse($module->pivot->completed_at)->format('d M Y') }}
                    </div>

                    {{-- RESULT --}}
                    <div class="mt-4">
                        @if($module->pivot->pass_status)
                            <span class="badge badge-active">
                                PASS
                            </span>
                        @else
                            <span class="badge badge-bad">
                                FAIL
                            </span>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</x-student-layout>
