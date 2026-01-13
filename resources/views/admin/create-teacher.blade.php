<x-admin-layout title="Create Teacher">

    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="card-strong p-10 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(34,211,238,.45) 0%, transparent 60%);"></div>

            <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl opacity-60"
                 style="background: radial-gradient(circle, rgba(99,102,241,.35) 0%, transparent 60%);"></div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                    Create Teacher
                </h1>
                <p class="text-slate-600 text-sm md:text-base mt-2 font-medium max-w-2xl">
                    Add a new teacher to the system. Teachers can later be assigned to academic modules
                    and manage enrolled students.
                </p>
            </div>
        </div>

        {{-- Form card --}}
        <div class="card p-8 max-w-2xl">
            <form method="POST" action="{{ route('admin.teachers.store') }}" class="space-y-6">
                @csrf

                {{-- FULL NAME --}}
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">
                        Full Name
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm
                               focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition"
                        
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">
                        Email Address
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm
                               focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition"
                    >
                    @error('email')
                        <p class="mt-2 text-sm text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-2">
                        Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full rounded-2xl border border-slate-200 bg-white/80 px-4 py-3 text-sm
                               focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition"
                        placeholder="Minimum 8 characters"
                    >
                    <p class="mt-2 text-xs text-slate-500 font-medium">
                        Minimum 8 characters
                    </p>
                    @error('password')
                        <p class="mt-2 text-sm text-rose-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ACTIONS --}}
                <div class="flex items-center justify-end gap-3 pt-5 border-t border-slate-200/70">
                    <a href="{{ route('admin.teachers.index') }}" class="btn-ghost">
                        Cancel
                    </a>

                    <button type="submit" class="btn-brand">
                        Create Teacher
                    </button>
                </div>

            </form>
        </div>

    </div>

</x-admin-layout>
