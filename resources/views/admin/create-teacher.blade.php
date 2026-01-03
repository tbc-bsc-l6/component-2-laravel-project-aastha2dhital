<x-admin-layout>

    {{-- ================= PAGE HEADER ================= --}}
    <div class="mb-10 rounded-3xl
                bg-gradient-to-r from-emerald-400 to-teal-300
                px-10 py-8 text-white shadow-xl">

        <h1 class="text-3xl font-bold flex items-center gap-3">
            ➕ Create Teacher
        </h1>

        <p class="mt-2 text-white/90 text-sm max-w-2xl">
            Add a new teacher to the system. Teachers can later be assigned
            to academic modules and manage enrolled students.
        </p>
    </div>

    {{-- ================= FORM CARD ================= --}}
    <div class="max-w-2xl bg-white rounded-3xl shadow-xl
                border border-slate-200 overflow-hidden">

        <form method="POST"
              action="{{ route('admin.teachers.store') }}"
              class="px-8 py-8 space-y-6">
            @csrf

            {{-- FULL NAME --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Full Name
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full rounded-xl border border-gray-300
                           px-4 py-3 text-sm
                           focus:outline-none
                           focus:ring-2 focus:ring-emerald-400">
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Email Address
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full rounded-xl border border-gray-300
                           px-4 py-3 text-sm
                           focus:outline-none
                           focus:ring-2 focus:ring-emerald-400">
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Password
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full rounded-xl border border-gray-300
                           px-4 py-3 text-sm
                           focus:outline-none
                           focus:ring-2 focus:ring-emerald-400">

                <p class="mt-1 text-xs text-gray-500">
                    Minimum 8 characters
                </p>
            </div>

            {{-- ACTIONS --}}
            <div class="flex items-center justify-end gap-4 pt-6 border-t">

                <a href="{{ route('admin.teachers.index') }}"
                   class="rounded-xl px-5 py-2.5
                          text-sm font-semibold
                          text-gray-700 bg-gray-100
                          hover:bg-gray-200 transition">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="rounded-xl px-6 py-2.5
                           text-sm font-extrabold text-white
                           bg-gradient-to-r from-emerald-400 to-teal-300
                           shadow-lg
                           hover:brightness-110
                           transition">
                    Create Teacher
                </button>

            </div>
        </form>
    </div>

</x-admin-layout>
