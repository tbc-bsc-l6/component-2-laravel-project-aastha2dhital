<x-admin-layout>

    {{-- HEADER --}}
    <div class="mb-8 rounded-3xl px-10 py-8
                bg-gradient-to-r from-emerald-400 to-teal-300
                text-white shadow-xl">
        <h1 class="text-3xl font-bold flex items-center gap-3">
            👩‍🏫 Teachers
        </h1>
        <p class="text-white/90 text-sm mt-1">
            Manage registered teachers and their assigned modules
        </p>
    </div>

    {{-- ACTION BAR --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold">Teacher List</h2>
            <p class="text-sm text-gray-600">
                Active teachers currently registered in the system
            </p>
        </div>

        <a href="{{ route('admin.teachers.create') }}"
           class="inline-flex items-center gap-2
                  px-6 py-3 rounded-xl
                  bg-gradient-to-r from-emerald-400 to-teal-300
                  text-white font-bold shadow-lg
                  hover:scale-105 transition">
            ➕ Add Teacher
        </a>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Assigned Modules</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($teachers as $teacher)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium">
                            {{ $teacher->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $teacher->email }}
                        </td>

                        {{-- ASSIGNED MODULES --}}
                        <td class="px-6 py-4">
                            @if($teacher->taughtModules->isEmpty())
                                <span class="text-xs text-gray-400 italic">
                                    No modules assigned
                                </span>
                            @else
                                <div class="flex flex-wrap gap-2">
                                    @foreach($teacher->taughtModules as $module)
                                        <span class="px-3 py-1 rounded-full
                                                     bg-emerald-100 text-emerald-700
                                                     text-xs font-semibold">
                                            {{ $module->module }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-6 py-4 text-right">
                            <form method="POST"
                                  action="{{ route('admin.teachers.destroy', $teacher) }}"
                                  onsubmit="return confirm('Remove this teacher?')"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button class="px-4 py-1 rounded-lg
                                               bg-red-100 text-red-600
                                               font-semibold hover:bg-red-200">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                            No teachers found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-admin-layout>
