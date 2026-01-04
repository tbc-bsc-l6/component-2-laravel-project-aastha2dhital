<x-admin-layout>

    {{-- ================= HEADER ================= --}}
    <div class="mb-8 flex items-center justify-between
                rounded-3xl px-10 py-7
                bg-gradient-to-r from-emerald-400 to-teal-300
                text-white shadow-xl">

        <div>
            <h1 class="text-2xl font-bold flex items-center gap-3">
                👨‍🏫 Teachers
            </h1>
            <p class="text-white/90 text-sm mt-1">
                Manage teachers and view assigned modules
            </p>
        </div>

        {{-- ADD TEACHER --}}
        <a href="{{ url('/admin/teachers/create') }}"
           class="inline-flex items-center gap-2
                  rounded-xl bg-white px-6 py-3
                  text-sm font-bold text-emerald-700
                  shadow hover:bg-emerald-50 transition">
            ➕ Add Teacher
        </a>
    </div>

    {{-- ================= TABLE ================= --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left w-48">Name</th>
                    <th class="px-6 py-3 text-left w-64">Email</th>
                    <th class="px-6 py-3 text-left">Assigned Modules</th>
                    <th class="px-6 py-3 text-right w-40">Assigned Date</th>
                    <th class="px-6 py-3 text-right w-32">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($teachers as $teacher)
                    <tr class="hover:bg-slate-50 align-top">

                        {{-- NAME --}}
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $teacher->name }}
                        </td>

                        {{-- EMAIL --}}
                        <td class="px-6 py-4 text-gray-600">
                            {{ $teacher->email }}
                        </td>

                        {{-- MODULES --}}
                        <td class="px-6 py-4">
                            @if($teacher->teachingModules->isEmpty())
                                <span class="text-xs italic text-gray-400">
                                    No modules assigned
                                </span>
                            @else
                                <div class="flex flex-wrap gap-2">
                                    @foreach($teacher->teachingModules as $module)
                                        <span class="rounded-full bg-emerald-100
                                                     px-3 py-1 text-xs font-semibold
                                                     text-emerald-700">
                                            {{ $module->module }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </td>

                        {{-- ✅ ASSIGNED DATE = TEACHER CREATED DATE --}}
                        <td class="px-6 py-4 text-right text-gray-600">
                            {{ $teacher->created_at?->format('d M Y') ?? '—' }}
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-6 py-4 text-right">
                            <form method="POST"
                                  action="{{ url('/admin/teachers/' . $teacher->id) }}"
                                  onsubmit="return confirm('Remove this teacher?')"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline font-semibold">
                                    🗑 Remove
                                </button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            No teachers found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</x-admin-layout>
