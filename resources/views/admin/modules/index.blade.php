<x-admin-layout>

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Modules</h2>
        <p class="text-gray-500">Manage system modules</p>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-3 text-left">Module</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach ($modules as $module)
                    <tr>
                        <td class="px-4 py-3 font-medium">
                            {{ $module->name }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded
                                {{ $module->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $module->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            <form method="POST"
                                  action="{{ route('admin.modules.toggle', $module) }}">
                                @csrf
                                @method('PATCH')

                                <button class="text-blue-600 hover:underline text-sm">
                                    Toggle
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-admin-layout>
