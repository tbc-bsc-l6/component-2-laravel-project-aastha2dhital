<x-teacher-layout>
    <h1 class="text-2xl font-bold mb-4">
        {{ $module->module }} – Students
    </h1>

    @if($students->isEmpty())
        <p class="text-gray-500">No active students in this module.</p>
    @else
        <table class="w-full bg-white rounded shadow">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-3">Student</th>
                    <th class="text-left p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr class="border-b">
                        <td class="p-3">{{ $student->name }}</td>
                        <td class="p-3 flex gap-2">

                            <form method="POST"
                                  action="{{ route('teacher.modules.grade', [$module, $student]) }}">
                                @csrf
                                <input type="hidden" name="status" value="pass">
                                <button class="bg-green-600 text-white px-3 py-1 rounded">
                                    PASS
                                </button>
                            </form>

                            <form method="POST"
                                  action="{{ route('teacher.modules.grade', [$module, $student]) }}">
                                @csrf
                                <input type="hidden" name="status" value="fail">
                                <button class="bg-red-600 text-white px-3 py-1 rounded">
                                    FAIL
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-teacher-layout>
