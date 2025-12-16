<!DOCTYPE html>
<html>
<head>
    <title>Enroll Student</title>
</head>
<body>

    <h2>
        Enroll Student to: {{ $module->name }}
    </h2>

    @if(session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <form method="POST" action="{{ route('admin.modules.enroll', $module->id) }}">
        @csrf

        <label>Select Student:</label><br><br>

        <select name="student_id" required>
            <option value="">-- Select Student --</option>

            @foreach($students as $student)
                <option value="{{ $student->id }}">
                    {{ $student->name }} ({{ $student->email }})
                </option>
            @endforeach
        </select>

        <br><br>

        <button type="submit">
            Enroll Student
        </button>
    </form>

</body>
</html>
