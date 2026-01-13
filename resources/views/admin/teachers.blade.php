<x-admin-layout title="Teachers">

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Big fancy page header --}}
        <div class="card-strong p-10 relative overflow-hidden flex items-center justify-between gap-6">
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(34,211,238,.45) 0%, transparent 60%);"></div>

            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(99,102,241,.35) 0%, transparent 60%);"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">Teachers</h1>
                <p class="text-slate-600 text-sm md:text-base mt-2 font-medium">
                    Manage teachers and view assigned modules
                </p>
            </div>

            <div class="relative z-10 shrink-0">
                <a href="{{ url('/admin/teachers/create') }}" class="btn-brand">
                    Add Teacher
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-card overflow-hidden">
            <table class="w-full text-sm">
                <thead class="table-head">
                <tr>
                    <th class="px-6 py-4 text-left w-48 font-bold">Name</th>
                    <th class="px-6 py-4 text-left w-64 font-bold">Email</th>
                    <th class="px-6 py-4 text-left font-bold">Assigned Modules</th>
                    <th class="px-6 py-4 text-right w-40 font-bold">Assigned Date</th>
                    <th class="px-6 py-4 text-right w-32 font-bold">Actions</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-slate-200/70 bg-white/40">
                @forelse($teachers as $teacher)
                    <tr class="table-row align-top">
                        <td class="px-6 py-4 font-semibold text-slate-900">
                            {{ $teacher->name }}
                        </td>

                        <td class="px-6 py-4 text-slate-600 font-medium">
                            {{ $teacher->email }}
                        </td>

                        <td class="px-6 py-4">
                            @if($teacher->teachingModules->isEmpty())
                                <span class="text-xs italic text-slate-400 font-medium">
                                    No modules assigned
                                </span>
                            @else
                                <div class="flex flex-wrap gap-2">
                                    @foreach($teacher->teachingModules as $module)
                                        <span class="badge badge-active">
                                            {{ $module->module }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-right text-slate-600 font-medium">
                            {{ $teacher->created_at?->format('d M Y') ?? '—' }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            <form method="POST"
                                  action="{{ url('/admin/teachers/' . $teacher->id) }}"
                                  onsubmit="return confirm('Remove this teacher?')"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-700 hover:underline font-semibold">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500 font-medium">
                            No teachers found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

</x-admin-layout>
