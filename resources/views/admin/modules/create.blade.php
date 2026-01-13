<x-admin-layout title="Create Module">

    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="card-strong p-10 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(34,211,238,.45) 0%, transparent 60%);"></div>

            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(99,102,241,.35) 0%, transparent 60%);"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                    Create Module
                </h1>
                <p class="text-slate-600 text-sm md:text-base mt-2 font-medium max-w-2xl">
                    Add a new academic module. You can later assign teachers, toggle availability, and archive it.
                </p>
            </div>
        </div>

        {{-- Form Card --}}
        <form method="POST" action="{{ route('admin.modules.store') }}">
            @csrf

            <div class="card p-8 space-y-6">

                <div>
                    <label for="module" class="block text-sm font-bold text-slate-800 mb-2">
                        Module Name
                    </label>

                    <input
                        type="text"
                        id="module"
                        name="module"
                        value="{{ old('module') }}"
                        required
                        class="w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm
                               focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition"
                      
                    >

                    <p class="mt-2 text-xs text-slate-500 font-medium">
                        This name will be visible to students and teachers.
                    </p>

                    @error('module')
                        <p class="mt-2 text-sm text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-slate-200/70">
                    <a href="{{ route('admin.modules.index') }}" class="btn-ghost">
                        Cancel
                    </a>

                    <button type="submit" class="btn-brand">
                        Create Module
                    </button>
                </div>

            </div>
        </form>

    </div>

</x-admin-layout>
