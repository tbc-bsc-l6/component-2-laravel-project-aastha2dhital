<x-admin-layout>

    {{-- HEADER --}}
    <div class="mb-8 rounded-3xl
                bg-gradient-to-r from-emerald-400 to-teal-300
                px-10 py-8 text-white shadow-xl">

        <h1 class="text-3xl font-bold flex items-center gap-3">
            🎓 Students
        </h1>

        <p class="mt-2 text-white/90 text-sm">
            Manage student accounts and enrollment status
        </p>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">

        <div class="px-8 py-6 border-b">
            <h2 class="text-xl font-bold text-gray-900">Student List</h2>
            <p class="text-sm text-gray-600">
                Active students in the system
            </p>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-slate-100 text-gray-600">
                <tr>
                    <th class="px-8 py-4 text-left font-semibold">Name</th>
                    <th class="px-8 py-4 text-left font-semibold">Email</th>
                    <th class="px-8 py-4 text-left font-semibold">Role</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($students as $student)
                    <tr class="hover:bg-slate-50">

                        <td class="px-8 py-4 font-medium text-gray-800">
                            {{ $student->name }}
                        </td>

                        <td class="px-8 py-4 text-gray-600">
                            {{ $student->email }}
                        </td>

                        <td class="px-8 py-4">
                            <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                Student
                            </span>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3"
                            class="px-8 py-10 text-center text-gray-500">
                            No students found.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>

</x-admin-layout>
