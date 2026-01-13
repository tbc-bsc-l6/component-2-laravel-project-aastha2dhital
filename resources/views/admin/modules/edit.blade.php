<x-admin-layout title="Assign Teachers">

    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="card-strong p-10 relative overflow-hidden flex items-center justify-between gap-6">
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(34,211,238,.45) 0%, transparent 60%);"></div>

            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(99,102,241,.35) 0%, transparent 60%);"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                    Assign Teachers
                </h1>
                <p class="text-slate-600 text-sm md:text-base mt-2 font-medium">
                    Module: <span class="font-semibold text-slate-900">{{ $module->module }}</span>
                </p>
            </div>

            <div class="relative z-10 shrink-0">
                <a href="{{ route('admin.modules.index') }}" class="btn-ghost">
                    Back
                </a>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="card p-8">
            <form method="POST" action="{{ route('admin.modules.update', $module) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-black text-slate-900 mb-2">
                        Available Teachers
                    </label>
                    <p class="text-sm text-slate-500 font-medium mb-4">
                        Select teachers who will teach this module.
                    </p>

                    <div class="grid sm:grid-cols-2 gap-4">
                        @foreach($teachers as $teacher)
                            <label class="flex items-start gap-3 rounded-2xl border border-slate-200/70 bg-white/70 backdrop-blur px-4 py-4 cursor-pointer hover:bg-white/90 transition">
                                <input
                                    type="checkbox"
                                    name="teachers[]"
                                    value="{{ $teacher->id }}"
                                    @checked($module->teachers->contains($teacher))
                                    class="mt-1 h-4 w-4 rounded text-sky-600 focus:ring-sky-400"
                                >
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-900">{{ $teacher->name }}</p>
                                    <p class="text-xs text-slate-500 font-medium truncate">{{ $teacher->email }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-200/70">
                    <a href="{{ route('admin.modules.index') }}" class="btn-ghost">
                        Cancel
                    </a>

                    <button type="submit" class="btn-brand">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-admin-layout>
