<x-admin-layout>
    <x-slot name="header">
        Students
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
                </tr>
            </thead>

            <tbody>
                @forelse($students as $student)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 font-medium">
                            {{ $student->name }}
                            <span 
                            class="ml-2 px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded cursor-default" 
                            title="Active student">
                            Active
                        </span>

                        </td>
                        <td class="p-3 text-gray-600">
                            {{ $student->email }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="p-4 text-center text-gray-500">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
