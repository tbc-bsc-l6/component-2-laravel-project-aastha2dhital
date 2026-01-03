<x-student-layout>

    {{-- ================= HEADER ================= --}}
    <div class="mb-8 rounded-2xl px-8 py-6
                bg-gradient-to-r from-teal-400 to-emerald-300
                text-white shadow-lg">
        <h2 class="text-2xl font-bold">
            🎓 Completed Modules
        </h2>
        <p class="text-white/90 mt-1">
            View your completed courses and results
        </p>
    </div>

    {{-- ================= SEARCH ================= --}}
    <form method="GET" class="mb-6 max-w-md flex gap-3">
        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Search completed modules..."
            class="flex-1 rounded-lg border border-slate-300 px-4 py-2 text-sm
                   focus:ring-2 focus:ring-emerald-400"
        >

        <button
            class="rounded-lg bg-emerald-600 px-5 py-2
                   text-sm font-semibold text-white
                   hover:bg-emerald-700 shadow">
            Search
        </button>
    </form>

    {{-- ================= COMPLETED MODULES ================= --}}
    <div class="rounded-2xl bg-white shadow-sm overflow-hidden">

        {{-- TABLE HEADER --}}
        <div class="grid grid-cols-4 gap-4 px-6 py-4
                    text-sm font-semibold text-slate-600 bg-slate-50">
            <div>Module</div>
            <div>Result</div>
            <div>Completed On</div>
            <div class="text-right">Status</div>
        </div>

        @forelse($completedModules as $module)

            @php
                $status = strtoupper($module->pass_status);
            @endphp

            {{-- ROW --}}
            <div class="grid grid-cols-4 gap-4 px-6 py-4
                        border-t items-center">

                {{-- MODULE NAME --}}
                <div class="font-medium text-slate-800">
                    {{ $module->module }}
                </div>

                {{-- RESULT --}}
                <div>
                    @if($status === 'PASS')
                        <span class="rounded-full bg-emerald-100
                                     px-3 py-1 text-xs font-semibold
                                     text-emerald-700">
                            PASS
                        </span>
                    @else
                        <span class="rounded-full bg-red-100
                                     px-3 py-1 text-xs font-semibold
                                     text-red-700">
                            FAIL
                        </span>
                    @endif
                </div>

                {{-- COMPLETED DATE --}}
                <div class="text-sm text-slate-600">
                    {{ \Carbon\Carbon::parse($module->completed_at)->format('d M Y') }}
                </div>

                {{-- STATUS ICON --}}
                <div class="text-right text-lg">
                    @if($status === 'PASS')
                        <span class="text-emerald-500">✔</span>
                    @else
                        <span class="text-red-500">✖</span>
                    @endif
                </div>

            </div>

        @empty
            {{-- EMPTY STATE --}}
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
