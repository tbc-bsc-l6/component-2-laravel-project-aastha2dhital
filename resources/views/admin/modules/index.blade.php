<x-admin-layout title="Modules">

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Big fancy page header --}}
        <div class="card-strong p-10 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(34,211,238,.45) 0%, transparent 60%);"></div>

            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(99,102,241,.35) 0%, transparent 60%);"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                    Academic Modules
                </h1>
                <p class="text-slate-600 text-sm md:text-base mt-2 max-w-2xl font-medium">
                    Manage modules, assign teachers, control availability, archive modules and review progress.
                </p>
            </div>
        </div>

        {{-- Title + button row --}}
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-slate-900">Module List</h2>
                <p class="text-sm text-slate-500 font-medium">All academic modules in the system</p>
            </div>

            <a href="{{ route('admin.modules.create') }}" class="btn-brand">
                Add Module
            </a>
        </div>

        {{-- Table --}}
        <div class="table-card">
            <table class="w-full text-sm">
                <thead class="table-head">
                <tr>
                    <th class="px-8 py-4 text-left font-bold">Module</th>
                    <th class="px-6 py-4 text-left font-bold">Status</th>
                    <th class="px-8 py-4 text-right font-bold">Actions</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-slate-200/70 bg-white/40">
                @forelse($modules as $module)
                    <tr class="table-row">
                        <td class="px-8 py-4 font-semibold text-slate-900">
                            {{ $module->module }}
                        </td>

                        <td class="px-6 py-4">
                            @if($module->isArchived())
                                <span class="badge badge-archived">Archived</span>
                            @elseif($module->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>

                        <td class="px-8 py-4 text-right">
                            <div class="inline-flex flex-wrap items-center justify-end gap-x-4 gap-y-2 font-semibold">

                                <a href="{{ route('admin.modules.edit', $module) }}"
                                   class="text-sky-700 hover:underline">
                                    Edit
                                </a>

                                <a href="{{ route('admin.modules.students', $module) }}"
                                   class="text-indigo-700 hover:underline">
                                    Students
                                </a>

                                @if(! $module->isArchived())
                                    <form method="POST" action="{{ route('admin.modules.toggle', $module) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-blue-700 hover:underline">
                                            Toggle
                                        </button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('admin.modules.archive', $module) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-rose-700 hover:underline">
                                        {{ $module->isArchived() ? 'Restore' : 'Archive' }}
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-8 py-12 text-center text-slate-500 font-medium">
                            No modules found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

</x-admin-layout>
