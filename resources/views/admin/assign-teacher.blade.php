<x-admin-layout title="Assign Teachers">

    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="card-strong p-10 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(34,211,238,.45) 0%, transparent 60%);"></div>

            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(99,102,241,.35) 0%, transparent 60%);"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                    Assign Teachers
                </h1>
                <p class="text-slate-600 text-sm md:text-base mt-2 font-medium max-w-2xl">
                    Module: <span class="font-semibold text-slate-900">{{ $module->module }}</span>
                </p>
            </div>
        </div>

        {{-- Form --}}
        <div class="card p-8">
            <form method="POST" action="{{ route('admin.modules.assign-teacher', $module) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <h2 class="text-lg font-black text-slate-900">Available Teachers</h2>
                    <p class="text-sm text-slate-500 font-medium">
                        Tick the teachers you want assigned to this module.
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    @forelse($teachers as $teacher)
                        <label class="flex items-start gap-3 rounded-2xl border border-slate-200/70 bg-white/70 backdrop-blur px-4 py-4 cursor-pointer hover:bg-white/90 transition">
                            <input
                                type="checkbox"
                                name="teachers[]"
                                value="{{ $teacher->id }}"
                                @checked($module->teachers->contains($teacher))
                                class="mt-1 h-4 w-4 rounded text-sky-600 focus:ring-sky-400"
                            >

                            <div class="min-w-0">
                                <div class="font-semibold text-slate-900">{{ $teacher->name }}</div>
                                <div class="text-xs text-slate-500 font-medium truncate">{{ $teacher->email }}</div>
                            </div>
                        </label>
                    @empty
                        <div class="text-slate-500 font-medium">
                            No teachers available.
                        </div>
                    @endforelse
                </div>

                <div class="flex justify-end gap-3 mt-8 pt-5 border-t border-slate-200/70">
                    <a href="{{ route('admin.modules.index') }}" class="btn-ghost">
                        Back
                    </a>
                    <button type="submit" class="btn-brand">
                        Save
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-admin-layout>
