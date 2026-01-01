<x-student-layout>

    <!-- ================= PAGE TITLE ================= -->
    <h2 class="mb-6 text-lg font-semibold text-slate-800">
        Completed Modules
    </h2>

    <!-- ================= COMPLETED MODULES ================= -->
    <div class="rounded-2xl bg-white shadow-sm overflow-hidden">

        <!-- TABLE HEADER -->
        <div class="grid grid-cols-4 gap-4 px-6 py-4 text-sm font-semibold text-slate-600 bg-slate-50">
            <div>Module</div>
            <div>Result</div>
            <div>Completed On</div>
            <div></div>
        </div>

        @forelse($completedModules as $module)

            <!-- ROW -->
            <div class="grid grid-cols-4 gap-4 px-6 py-4 border-t items-center">

                <!-- MODULE NAME -->
                <div class="font-medium text-slate-800">
                    {{ $module->module }}
                </div>

                <!-- RESULT -->
                <div>
                    @if($module->pass_status === 'pass')
                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Pass
                        </span>
                    @else
                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                            Fail
                        </span>
                    @endif
                </div>

                <!-- COMPLETED DATE -->
                <div class="text-sm text-slate-600">
                    {{ \Carbon\Carbon::parse($module->completed_at)->format('d M Y') }}
                </div>

                <!-- STATUS ICON -->
                <div class="text-right">
                    @if($module->pass_status === 'pass')
                        <span class="text-green-500 text-lg">✔</span>
                    @else
                        <span class="text-red-500 text-lg">✖</span>
                    @endif
                </div>

            </div>

        @empty
            <!-- EMPTY STATE -->
            <div class="px-6 py-12 text-center text-slate-500">
                <div class="text-4xl mb-3">🎓</div>
                <p class="font-medium">No completed modules yet</p>
                <p class="text-sm mt-1">
                    Your completed courses will appear here once finished.
                </p>
            </div>
        @endforelse

    </div>

</x-student-layout>
