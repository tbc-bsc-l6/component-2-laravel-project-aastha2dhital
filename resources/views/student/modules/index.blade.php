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
            class="flex-1 rounded-full border border-gray-300 px-5 py-2
                   text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400"
        >

        <button
            class="rounded-full px-5 py-2 text-sm font-semibold text-white
                   bg-gradient-to-r from-emerald-600 to-teal-500
                   hover:opacity-90 transition">
            Search
        </button>
    </form>

    <!-- ================= MY MODULES ================= -->
    <h3 class="mb-2 text-lg font-semibold text-gray-800">My Modules</h3>

    @if($enrolledModules->isEmpty())
        <p class="mb-10 text-sm text-gray-500">
            You are not enrolled in any modules.
        </p>
    @endif

    <!-- ================= AVAILABLE MODULES ================= -->
    <h3 class="mb-5 text-lg font-semibold text-gray-800">
        Available Modules
    </h3>

    {{-- SEARCH RESULT EMPTY --}}
    @if(request('search') && $availableModules->isEmpty())
        <div class="rounded-xl bg-white p-6 text-center text-sm text-gray-500 shadow">
            ❌ No modules available for your search.
        </div>
    @elseif($availableModules->isEmpty())
        <div class="rounded-xl bg-white p-6 text-center text-sm text-gray-500 shadow">
            No modules available.
        </div>
    @else

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @foreach($availableModules as $module)

                <div
                    class="group relative rounded-2xl
                           bg-gradient-to-br from-emerald-500 to-teal-600
                           p-[1px] transition-all duration-300
                           hover:-translate-y-1">

                    <!-- INNER CARD -->
                    <div
                        class="relative rounded-2xl bg-white p-6
                               shadow-sm transition group-hover:shadow-xl">

                        <!-- MODULE NAME -->
                        <h4 class="text-lg font-bold text-gray-900">
                            {{ $module->module }}
                        </h4>

                        <!-- CAPACITY -->
                        <p class="mt-2 text-xs text-gray-600">
                            Capacity: {{ $module->students_count }} / 10
                        </p>

                        <!-- ACTION -->
                        <div class="mt-4 flex items-center justify-between">

                            @if($enrolledModules->count() < 4)

                                <form method="POST"
                                      action="{{ route('student.modules.enrol', $module->id) }}">
                                    @csrf
                                    <button
                                        class="rounded-full bg-gradient-to-r
                                               from-emerald-600 to-teal-500
                                               px-4 py-1.5 text-xs font-semibold
                                               text-white shadow
                                               hover:scale-105 hover:opacity-90
                                               transition">
                                        Enroll
                                    </button>
                                </form>

                            @else
                                <span
                                    class="rounded-full bg-gray-200 px-3 py-1
                                           text-xs text-gray-500">
                                    Max reached
                                </span>
                            @endif

                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    @endif

</x-student-layout>
