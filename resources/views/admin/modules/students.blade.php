<x-admin-layout>
    <x-slot name="header">
        Students — {{ $module->module }}
    </x-slot>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($students as $student)
                    <tr class="border-t">
                        <td class="p-3">{{ $student->name }}</td>
                        <td class="p-3">{{ $student->email }}</td>
                        <td class="p-3">
                            {{-- ✅ REMOVE STUDENT --}}
                            <form method="POST"
                                  action="{{ route('admin.modules.students.remove', [$module, $student]) }}"
                                  onsubmit="return confirm('Remove this student from the module?')"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-600 hover:underline">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            No students enrolled in this module.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
