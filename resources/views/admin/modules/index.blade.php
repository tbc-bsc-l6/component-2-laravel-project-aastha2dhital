<x-admin-layout>

    {{-- ================= PAGE HEADER ================= --}}
    <div class="mb-10 flex flex-col gap-6">

        {{-- Gradient Title --}}
        <div
            class="rounded-3xl bg-gradient-to-r from-emerald-500 via-teal-500 to-green-500
                   px-10 py-8 text-white shadow-xl">

            <h1 class="text-3xl font-bold flex items-center gap-3">
                📚 Academic Modules
            </h1>

            <p class="mt-2 text-white/90 text-sm max-w-2xl">
                Manage modules, assign teachers, control availability,
                archive unused modules, and review student progress.
            </p>
        </div>

        {{-- ACTION BAR --}}
        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    Module List
                </h2>
                <p class="text-sm text-gray-600">
                    All academic modules in the system
                </p>
            </div>

            {{-- ADD MODULE BUTTON (FINAL & CLEAN) --}}
            <a href="{{ route('admin.modules.create') }}"
               class="
                    inline-flex items-center gap-2
                    px-7 py-3
                    rounded-xl
                    bg-gradient-to-r from-emerald-500 via-teal-500 to-green-500
                    text-white
                    text-sm font-extrabold
                    shadow-lg
                    ring-2 ring-emerald-600/40
                    hover:brightness-110
                    hover:shadow-xl
                    transition
               ">
                ➕ Add Module
            </a>

        </div>
    </div>

    {{-- ================= MODULE TABLE CARD ================= --}}
    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-gray-600">
                <tr>
                    <th class="px-8 py-4 text-left font-semibold">Module</th>
                    <th class="px-6 py-4 text-left font-semibold">Status</th>
                    <th class="px-8 py-4 text-right font-semibold">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($modules as $module)
                    <tr class="hover:bg-slate-50 transition">

                        <td class="px-8 py-4 font-medium text-gray-800">
                            {{ $module->module }}
                        </td>

                        <td class="px-6 py-4">
                            @if($module->isArchived())
                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                    Archived
                                </span>
                            @elseif($module->is_active)
                                <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    Active
                                </span>
                            @else
                                <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td class="px-8 py-4 text-right">
                            <div class="inline-flex items-center gap-4 font-semibold">

                                <a href="{{ route('admin.modules.edit', $module) }}"
                                   class="text-emerald-600 hover:underline">
                                    ✏️ Edit
                                </a>

                                <a href="{{ route('admin.modules.students', $module) }}"
                                   class="text-indigo-600 hover:underline">
                                    👥 Students
                                </a>

                                @if(! $module->isArchived())
                                    <form method="POST"
                                          action="{{ route('admin.modules.toggle', $module) }}"
                                          class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="text-blue-600 hover:underline">
                                            🔁 Toggle
                                        </button>
                                    </form>
                                @endif

                                <form method="POST"
                                      action="{{ route('admin.modules.archive', $module) }}"
                                      class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-red-600 hover:underline">
                                        {{ $module->isArchived() ? '♻ Restore' : '📦 Archive' }}
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-8 py-10 text-center text-gray-500">
                            No modules found.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>

</x-admin-layout>
