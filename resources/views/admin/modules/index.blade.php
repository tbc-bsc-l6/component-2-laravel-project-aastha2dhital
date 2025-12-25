<x-admin-layout>
    <x-slot name="header">Modules</x-slot>
    <x-slot name="subheader">Manage system modules</x-slot>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Top Action Bar --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Modules</h2>
            <p class="text-sm text-gray-500">
                Create and manage academic modules
            </p>
        </div>

        <a href="{{ route('admin.modules.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5
                  text-sm font-medium text-white shadow hover:bg-indigo-700 transition">
            <span class="text-lg leading-none">+</span>
            Add Module
        </a>
    </div>

    {{-- Modules Table --}}
    @if ($modules->count())
        <div class="overflow-hidden rounded-xl bg-white shadow">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 text-left">Module Name</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($modules as $module)
                        <tr class="hover:bg-gray-50 transition">
                            {{-- Module Name --}}
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $module->module }}
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium
                                    {{ $module->is_active
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">
                                    {{ $module->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right space-x-3">
                                {{-- Toggle --}}
                                <form method="POST"
                                      action="{{ route('admin.modules.toggle', $module) }}"
                                      class="inline">
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="rounded-md px-3 py-1.5 text-xs font-medium
                                               text-indigo-600 hover:bg-indigo-50 transition">
                                        Toggle
                                    </button>
                                </form>

                                {{-- Edit / Assign Teacher --}}
                                <a href="{{ route('admin.modules.edit', $module) }}"
                                   class="text-sm font-medium text-indigo-600 hover:text-indigo-800 underline">
                                    Edit / Assign Teacher
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        {{-- Empty State --}}
        <div
            class="flex flex-col items-center justify-center rounded-2xl
                   bg-gradient-to-br from-indigo-50 to-white p-12 text-center shadow">
            <div
                class="mb-4 flex h-14 w-14 items-center justify-center
                       rounded-full bg-indigo-100 text-indigo-600 text-2xl">
                📘
            </div>

            <h3 class="text-lg font-semibold text-gray-800 mb-1">
                No modules created yet
            </h3>

            <p class="text-sm text-gray-500 max-w-md mb-6">
                Start by creating a module. You’ll then be able to assign teachers
                and enroll students into it.
            </p>

            <a href="{{ route('admin.modules.create') }}"
               class="inline-flex items-center gap-2 rounded-lg
                      bg-indigo-600 px-6 py-2.5 text-sm font-medium
                      text-white shadow hover:bg-indigo-700 transition">
                + Create First Module
            </a>
        </div>
    @endif
</x-admin-layout>
