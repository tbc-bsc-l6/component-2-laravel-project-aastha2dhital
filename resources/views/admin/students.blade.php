<!-- resources/views/admin/students.blade.php -->
<x-admin-layout>
    <x-slot name="header">Students</x-slot>
    <x-slot name="subheader">Manage current students</x-slot>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($students as $student)
                    <tr>
                        <td class="px-4 py-3 font-medium">{{ $student->name }}</td>
                        <td class="px-4 py-3">{{ $student->email }}</td>
                        <td class="px-4 py-3">
                            <form method="POST" action="{{ route('admin.students.destroy', $student) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline text-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
