<x-student-layout>

    <!-- ================= SEARCH ================= -->
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
    @if(request('search') && $modules->isEmpty())
        <div class="mb-6 rounded-xl border border-yellow-300 bg-yellow-50 px-4 py-3 text-sm text-yellow-800">
            ⚠️ Module not available
        </div>
    @endif

    @if(!request('search') && $activeCount >= 4)
        <div class="mb-6 rounded-xl border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
            ⚠️ You have reached the maximum of 4 active modules.
        </div>
    @endif

    <!-- ================= MODULE CARDS ================= -->
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

        @forelse($modules as $module)

            <div class="student-card shadow-sm">

                <!-- STATUS -->
                <div class="mb-2">
                    @if($module->already_enrolled)
                        <span class="bg-gray-200 text-gray-700">
                            Enrolled
                        </span>
                    @elseif($module->is_full)
                        <span class="bg-red-200 text-red-800">
                            Full
                        </span>
                    @else
                        <span class="bg-green-200 text-green-800">
                            Available
                        </span>
                    @endif
                </div>

                <!-- MODULE TITLE -->
                <h3>
                    {{ $module->module }}
                </h3>

                <!-- ACTION -->
                <div class="mt-4 flex justify-end">
                    @if(!$module->already_enrolled && !$module->is_full && $activeCount < 4)
                        <form method="POST"
                              action="{{ route('student.modules.enroll', $module->id) }}">
                            @csrf
                            <button
                                class="student-enroll-btn bg-gradient-to-r
                                       from-emerald-500 to-teal-400
                                       text-white font-semibold
                                       hover:opacity-90 transition">
                                Enroll
                            </button>
                        </form>
                    @else
                        <button
                            disabled
                            class="student-enroll-btn bg-gray-300
                                   text-gray-600 cursor-not-allowed">
                            Enroll
                        </button>
                    @endif
                </div>

            </div>

        @empty
            <div class="col-span-full rounded-xl bg-white p-10 text-center text-gray-500 shadow">
                No modules found.
            </div>
        @endforelse

    </div>

</x-student-layout>
