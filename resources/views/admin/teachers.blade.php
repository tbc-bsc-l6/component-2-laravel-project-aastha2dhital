<x-admin-layout>
    <x-slot name="header">Teachers</x-slot>
    <x-slot name="subheader">Manage system teachers</x-slot>

    <div class="mb-6 flex justify-end">
        <a href="{{ route('admin.teachers.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Add Teacher
        </a>
    </div>

    <div class="bg-white shadow rounded">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                    <tr class="border-t">
                        <td class="px-6 py-3">{{ $teacher->name }}</td>
                        <td class="px-6 py-3">{{ $teacher->email }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-6 text-center text-gray-500">
                            No teachers created yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
