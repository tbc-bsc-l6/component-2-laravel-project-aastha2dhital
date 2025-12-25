<x-admin-layout>
    <x-slot name="header">Teachers</x-slot>
    <x-slot name="subheader">Manage system teachers</x-slot>

    {{-- Success message --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Add Teacher Button --}}
    <div class="mb-6 flex justify-end">
        <a href="{{ route('admin.teachers.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Add Teacher
        </a>
    </div>

    {{-- Teachers Table --}}
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($teachers as $teacher)
                    <tr class="border-t">
                        <td class="px-6 py-3">
                            {{ $teacher->name }}
                        </td>

                        <td class="px-6 py-3">
                            {{ $teacher->email }}
                        </td>

                        <td class="px-6 py-3">
                            {{-- Remove Teacher --}}
                            <form method="POST"
                                  action="{{ route('admin.teachers.destroy', $teacher) }}"
                                  onsubmit="return confirm('Are you sure you want to remove this teacher?')"
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
                        <td colspan="3"
                            class="px-6 py-6 text-center text-gray-500">
                            No teachers created yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
