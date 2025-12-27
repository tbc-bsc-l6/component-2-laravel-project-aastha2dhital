<x-admin-layout>
    <x-slot name="header">Enroll Student</x-slot>
    <x-slot name="subheader">
        Enroll a student into module: <strong>{{ $module->name }}</strong>
    </x-slot>

    <div class="max-w-xl bg-white rounded-xl shadow p-6">

        {{-- Validation / Errors --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.modules.enroll-student.store', $module) }}">
            @csrf

            {{-- Student Dropdown --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Select Student
                </label>

                <select
                    name="student_id"
                    class="w-full border rounded p-2"
                    required
                >
                    <option value="">-- Select a student --</option>

                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">
                            {{ $student->name }} ({{ $student->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-2">
                <a
                    href="{{ route('admin.modules.index') }}"
                    class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-100">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Enroll Student
                </button>
            </div>

        </form>
    </div>
</x-admin-layout>
