<x-admin-layout>

    {{-- ================= HEADER ================= --}}
    <div class="mb-10 rounded-3xl
                bg-gradient-to-r from-emerald-400 via-teal-400 to-green-400
                px-10 py-8 text-white shadow-xl">

        <h1 class="text-3xl font-bold flex items-center gap-3">
            🧑‍🏫 Assign Teachers
        </h1>

        <p class="mt-2 text-white/90 text-sm max-w-2xl">
            Assign or remove teachers responsible for this module.
        </p>
    </div>

    {{-- ================= CARD ================= --}}
    <div class="max-w-3xl bg-white rounded-3xl shadow-lg border border-slate-100">

        {{-- TOP BAR --}}
        <div class="flex items-center justify-between
                    px-8 py-5 border-b bg-slate-50 rounded-t-3xl">

            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    Module: {{ $module->module }}
                </h2>
                <p class="text-sm text-gray-500">
                    Select teachers assigned to this module
                </p>
            </div>

            {{-- BACK BUTTON --}}
            <a href="{{ route('admin.modules.index') }}"
               class="rounded-xl border border-gray-300
                      px-4 py-2 text-sm font-semibold text-gray-700
                      hover:bg-gray-100 transition">
                ← Back
            </a>
        </div>

        {{-- ================= FORM ================= --}}
        <form method="POST"
              action="{{ route('admin.modules.update', $module) }}"
              class="px-8 py-6 space-y-6">

            @csrf
            @method('PUT')

            {{-- TEACHERS LIST --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    Available Teachers
                </label>

                <div class="grid sm:grid-cols-2 gap-4">
                    @foreach($teachers as $teacher)
                        <label
                            class="flex items-center gap-3 rounded-xl border
                                   px-4 py-3 cursor-pointer
                                   hover:bg-slate-50 transition">

                            <input
                                type="checkbox"
                                name="teachers[]"
                                value="{{ $teacher->id }}"
                                @checked($module->teachers->contains($teacher))
                                class="h-4 w-4 text-emerald-500
                                       focus:ring-emerald-400 rounded">

                            <div>
                                <p class="font-medium text-gray-800">
                                    {{ $teacher->name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $teacher->email }}
                                </p>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex items-center justify-end gap-4 pt-4 border-t">

                <a href="{{ route('admin.modules.index') }}"
                   class="rounded-xl border border-gray-300
                          px-5 py-2.5 text-sm font-semibold text-gray-700
                          hover:bg-gray-100 transition">
                    Cancel
                </a>

                <button
                    class="rounded-xl bg-emerald-500
                           px-6 py-2.5 text-sm font-semibold text-white
                           shadow hover:bg-emerald-600 transition">
                    💾 Save Changes
                </button>
            </div>

        </form>
    </div>

</x-admin-layout>
