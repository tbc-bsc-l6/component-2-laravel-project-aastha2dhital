<x-student-layout>

    {{-- SUCCESS / ERROR MESSAGES --}}
    @if(session('error'))
        <div class="mb-6 rounded-xl bg-red-100 px-4 py-3 text-sm text-red-700">
            ❌ {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="mb-6 rounded-xl bg-emerald-100 px-4 py-3 text-sm text-emerald-700">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- SEARCH --}}
    <form method="GET" class="mb-6 flex max-w-md gap-3">
        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Search modules..."
            class="flex-1 rounded-lg border border-gray-300
                   px-4 py-2 text-sm
                   focus:ring-2 focus:ring-emerald-400">

        <button
            class="rounded-lg bg-emerald-500
                   px-5 py-2 text-sm font-semibold
                   text-white hover:bg-emerald-600">
            Search
        </button>
    </form>

    {{-- MY MODULES --}}
    <h2 class="mb-3 text-lg font-semibold text-gray-800">
        My Modules
    </h2>

    @if($activeModules->isEmpty())
        <p class="mb-8 text-sm text-gray-500">
            You are not enrolled in any modules.
        </p>
    @else
        <div class="mb-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($activeModules as $module)
                <div class="rounded-xl bg-white p-4 shadow-sm">
                    <h3 class="font-medium text-gray-800">
                        {{ $module->module }}
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Enrolled:
                        {{ optional($module->pivot)->enrolled_at }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif

    {{-- AVAILABLE MODULES --}}
    <h2 class="mb-3 text-lg font-semibold text-gray-800">
        Available Modules
    </h2>

    @if($availableModules->isEmpty())
        <div class="rounded-xl bg-white p-6 text-center shadow-sm">
            <p class="text-sm text-gray-500">
                {{ ($search ?? false) ? 'Module not available.' : 'No modules available.' }}
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($availableModules as $module)
                <div class="rounded-xl bg-white p-4 shadow-sm
                            hover:shadow-md transition">

                    <h3 class="font-medium text-gray-800">
                        {{ $module->module }}
                    </h3>

                    <div class="mt-4 flex justify-end">
                        @if(method_exists($module, 'hasAvailableSeat') && ! $module->hasAvailableSeat())
                            {{-- MODULE FULL --}}
                            <span
                                class="rounded-full bg-gray-200 px-4 py-1.5
                                       text-xs font-semibold text-gray-600">
                                Module Full
                            </span>
                        @else
                            {{-- ENROL BUTTON --}}
                            <form
                                method="POST"
                                action="{{ route('student.modules.enrol', $module) }}">
                                @csrf
                                <button
                                    class="inline-flex items-center
                                           rounded-full bg-emerald-500
                                           px-4 py-1.5 text-xs
                                           font-semibold text-white
                                           hover:bg-emerald-600">
                                    Enrol
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</x-student-layout>
