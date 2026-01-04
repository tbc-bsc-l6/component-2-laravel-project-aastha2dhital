<x-student-layout>

    <h1 class="mb-6 text-2xl font-bold">
        Completed Modules
    </h1>

    @if($completedModules->isEmpty())
        <p class="text-gray-500">
            No completed modules.
        </p>
    @else
        <table class="w-full rounded-xl bg-white shadow">
            <thead class="border-b text-gray-600">
                <tr>
                    <th class="p-4 text-left">Module</th>
                    <th class="p-4 text-center">Result</th>
                    <th class="p-4 text-center">Completed At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($completedModules as $enrol)
                    <tr class="border-b last:border-0">
                        <td class="p-4">
                            {{ $enrol->module->module }}
                        </td>
                        <td class="p-4 text-center">
                            {{ $enrol->pass_status }}
                        </td>
                        <td class="p-4 text-center">
                            {{ $enrol->completed_at }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</x-student-layout>
