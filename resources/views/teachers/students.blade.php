@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-semibold">Module Students</h1>

    @if (session('success'))
        <p class="text-green-600 mb-3">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($module->students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->pivot->status ?? 'IN PROGRESS' }}</td>
                <td>
                    <form method="POST"
                          action="{{ route('teacher.students.result', [$module->id, $student->id]) }}">
                        @csrf
                        <select name="status">
                            <option value="PASS">PASS</option>
                            <option value="FAIL">FAIL</option>
                        </select>
                        <button type="submit">Save</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
