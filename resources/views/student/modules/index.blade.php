<x-student-layout>

    <!-- ================= SEARCH (AVAILABLE MODULES ONLY) ================= -->
    <form method="GET"
          action="{{ route('student.modules.index') }}"
          class="mb-8 flex max-w-xl items-center gap-3">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search modules..."
            class="flex-1 rounded-xl border border-gray-300 px-4 py-2
                   text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400"
        >

        <button
            class="rounded-full px-4 py-2 text-sm font-semibold text-white
                   bg-gradient-to-r from-emerald-500 to-teal-400
                   hover:opacity-90 transition">
            Search
        </button>
    </form>

    <!-- ================= WARNINGS ================= -->
    @if($enrolledModules->count() >= 4)

        <div class="mb-6 rounded-xl border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
            ⚠️ You have reached the maximum of 4 active modules.
            Enrollment is disabled.
        </div>
    @endif

    <!-- ================= MY MODULES ================= -->
    <h3 class="mb-4 text-lg font-semibold">My Modules</h3>

    @if($enrolledModules->isEmpty())
        <p class="mb-8 text-gray-500">You are not enrolled in any modules.</p>
    @else
        <div class="mb-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($enrolledModules as $module)
                <div class="student-card rounded-xl bg-white p-5 shadow">
                    <span class="mb-2 inline-block rounded-full bg-blue-100 px-3 py-1
                                 text-xs font-semibold text-blue-700">
                        Enrolled
                    </span>

                    <h3 class="text-base font-semibold text-slate-800">
                        {{ $module->module }}
                    </h3>
                </div>
            @endforeach
        </div>
    @endif

    {{-- AVAILABLE MODULES --}}
<div class="mt-10">
    <h3 class="mb-4 text-lg font-semibold text-gray-800">
        Available Modules
    </h3>

    @if($availableModules->isEmpty())
        <div class="rounded-lg bg-white p-6 text-center text-gray-500 shadow">
            No modules available.
        </div>
    @else
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($availableModules as $module)
                <div class="rounded-2xl bg-white p-6 shadow hover:shadow-lg transition">

                    {{-- MODULE NAME --}}
                    <h4 class="text-xl font-bold text-gray-800">
                        {{ $module->name }}
                    </h4>

                    {{-- OPTIONAL INFO --}}
                    <p class="mt-2 text-sm text-gray-600">
                        Capacity: {{ $module->students_count ?? $module->students()->count() }} / 10
                    </p>

                    {{-- ENROLL BUTTON --}}
                    <form method="POST"
                          action="{{ route('student.modules.enrol', $module->id) }}"
                          class="mt-4">
                        @csrf
                        <button
                            class="w-full rounded-xl bg-emerald-500 px-4 py-2
                                   font-semibold text-white hover:bg-emerald-600 transition">
                            Enrol
                        </button>
                    </form>

                </div>
            @endforeach
        </div>
    @endif
</div>

</x-student-layout>
