<x-admin-layout>

    {{-- HEADER --}}
    <div class="mb-8 rounded-2xl bg-gradient-to-r from-emerald-400 to-teal-300 px-8 py-6 text-white shadow">
        <h1 class="text-2xl font-bold flex items-center gap-2">
            📚 Academic Modules
        </h1>
        <p class="text-white/90 text-sm">
            Manage modules, teachers, students, availability, and archiving
        </p>
    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow border">

        {{-- TOP BAR --}}
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Module List</h2>
                <p class="text-sm text-gray-500">All modules in the system</p>
            </div>

            {{-- ADD MODULE BUTTON (FIXED) --}}
            <a href="{{ route('admin.modules.create') }}"
               class="inline-flex items-center gap-2 rounded-xl
                      bg-emerald-500 px-4 py-2 text-sm font-semibold
                      text-white hover:bg-emerald-600 transition">
                ➕ Add Module
            </a>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left">Module</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($modules as $module)
                        <tr class="hover:bg-slate-50">

                            {{-- MODULE NAME --}}
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $module->module }}
                            </td>

                            {{-- STATUS --}}
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

                            {{-- ACTIONS --}}
                            <td class="px-6 py-4 text-right space-x-4">

                                {{-- EDIT --}}
                                <a href="{{ route('admin.modules.edit', $module) }}"
                                   class="text-emerald-600 font-semibold hover:underline">
                                    ✏️ Edit
                                </a>

                                {{-- STUDENTS --}}
                                <a href="{{ route('admin.modules.students', $module) }}"
                                   class="text-indigo-600 font-semibold hover:underline">
                                    👥 Students
                                </a>

                                {{-- TOGGLE --}}
                                @if(! $module->isArchived())
                                    <form action="{{ route('admin.modules.toggle', $module) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="text-blue-600 font-semibold hover:underline">
                                            🔁 Toggle
                                        </button>
                                    </form>
                                @endif

                                {{-- ARCHIVE / RESTORE --}}
                                <form action="{{ route('admin.modules.archive', $module) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('PATCH')

                                    <button class="text-red-600 font-semibold hover:underline">
                                        {{ $module->isArchived() ? '♻ Restore' : '📦 Archive' }}
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>
