<x-admin-layout>

    {{-- ================= PAGE HEADER ================= --}}
    <div class="mb-10 rounded-3xl
                bg-gradient-to-r from-emerald-500 to-teal-400
                px-10 py-8 text-white shadow-xl">

        <h1 class="text-3xl font-bold flex items-center gap-3">
            ➕ Create Module
        </h1>

        <p class="mt-2 text-white/90 text-sm max-w-2xl">
            Add a new academic module to the system. Modules can later be activated,
            assigned to teachers, and enrolled by students.
        </p>
    </div>

    {{-- ================= FORM CARD ================= --}}
    <form method="POST"
          action="{{ route('admin.modules.store') }}"
          class="max-w-3xl">

        @csrf

        <div class="bg-white rounded-2xl
                    shadow-lg border border-gray-200
                    relative overflow-hidden">

            {{-- Accent strip --}}
            <div class="absolute inset-x-0 top-0 h-1
                        bg-gradient-to-r from-emerald-500 to-teal-400"></div>

            {{-- CARD HEADER --}}
            <div class="px-8 pt-6 pb-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">
                    Module Details
                </h2>
            </div>

            {{-- CARD BODY --}}
            <div class="px-8 py-6 space-y-6">

                <div>
                    <label for="module"
                           class="block text-sm font-semibold
                                  text-gray-700 mb-1">
                        Module Name
                    </label>

                    <input type="text"
                           id="module"
                           name="module"
                           value="{{ old('module') }}"
                           required
                           class="w-full rounded-xl
                                  border border-gray-300
                                  px-4 py-3 text-sm
                                  focus:outline-none focus:ring-2
                                  focus:ring-emerald-500
                                  focus:border-emerald-500
                                  transition">

                    <p class="mt-2 text-xs text-gray-500">
                        This name will be visible to students and teachers
                    </p>

                    @error('module')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>

            {{-- CARD FOOTER --}}
            <div class="flex justify-end gap-3 px-8 py-4
                        border-t bg-gray-50">

                <a href="{{ route('admin.modules.index') }}"
                   class="rounded-lg px-4 py-2
                          text-sm font-semibold
                          text-gray-700 bg-white
                          border border-gray-300
                          hover:bg-gray-100 transition">
                    Cancel
                </a>

                <button type="submit"
                        class="rounded-lg px-6 py-2
                               text-sm font-semibold text-white
                               bg-emerald-600
                               hover:bg-emerald-700
                               transition shadow-sm">
                    Create Module
                </button>
            </div>

        </div>
    </form>

</x-admin-layout>
