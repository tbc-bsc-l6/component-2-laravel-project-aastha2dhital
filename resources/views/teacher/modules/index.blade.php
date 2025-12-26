<x-teacher-layout>
    <div class="min-h-screen bg-slate-100">

        {{-- HEADER --}}
        <div class="bg-gradient-to-r from-slate-900 to-slate-800">
            <div class="max-w-7xl mx-auto px-8 py-12">
                <h1 class="text-3xl font-bold text-white tracking-tight">
                    Teacher Dashboard
                </h1>
                <p class="mt-2 text-slate-300 text-sm">
                    Overview of your assigned modules and students
                </p>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="max-w-7xl mx-auto px-8 py-12">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">
                        Assigned Modules
                    </h2>
                    <p class="text-sm text-slate-500">
                        Modules you are currently teaching
                    </p>
                </div>
            </div>

            @if($modules->isEmpty())
                {{-- EMPTY STATE --}}
                <div class="bg-white rounded-xl border border-slate-200 p-10 text-center">
                    <div class="mx-auto mb-4 h-12 w-12 rounded-full bg-slate-100 flex items-center justify-center text-xl">
                        🎓
                    </div>
                    <h3 class="font-semibold text-slate-800">
                        No modules assigned
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">
                        An administrator will assign modules to you shortly.
                    </p>
                </div>
            @else
                {{-- GRID --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($modules as $module)
                        <div class="bg-white rounded-xl border border-slate-200
                                    shadow-sm hover:shadow-md transition">

                            <div class="p-6 flex flex-col h-full">

                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold text-slate-900 leading-snug">
                                        {{ $module->module }}
                                    </h3>
                                    <p class="text-sm text-slate-500 mt-1">
                                        Active students:
                                        <span class="font-medium text-slate-700">
                                            {{ $module->users()->wherePivotNull('completed_at')->count() }}
                                        </span>
                                    </p>
                                </div>

                                <div class="mt-auto">
                                    <a href="{{ route('teacher.modules.show', $module) }}"
                                       class="inline-flex w-full items-center justify-center
                                              rounded-lg bg-slate-900 px-4 py-2.5
                                              text-sm font-medium text-white
                                              hover:bg-slate-800 transition">
                                        View Students
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-teacher-layout>
