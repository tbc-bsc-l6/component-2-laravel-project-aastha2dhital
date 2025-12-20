<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Student Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Dashboard Header --}}
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <p class="text-gray-600">
                    Welcome, {{ auth()->user()->name }}
                </p>

                <div class="mt-4">
                    <button
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 transition">
                        View Available Modules
                    </button>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-5">
                    <p class="text-sm text-gray-500">
                        Total Enrolled Modules
                    </p>

                    <p class="text-3xl font-bold text-gray-800 mt-1">
                        {{ $modules->count() }}
                    </p>
                </div>
            </div>

            {{-- Modules --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4">
                    My Enrolled Modules
                </h3>

                @if($modules->isEmpty())
                    <p class="text-gray-600">
                        You are not enrolled in any modules yet.
                    </p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($modules as $module)
                            <div class="border rounded-lg p-5 hover:shadow-md transition">
                                <h4 class="text-lg font-semibold text-gray-800">
                                    {{ $module->name }}
                                </h4>

                                <p class="text-sm text-gray-600 mt-1">
                                    Module enrolled
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
