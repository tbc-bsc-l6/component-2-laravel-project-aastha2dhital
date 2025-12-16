<h1>Assign Teacher to Module</h1>

<p><strong>Module:</strong> {{ $module->name }}</p>

<form method="POST" action="{{ route('admin.assign.submit', $module->id) }}">
    @csrf

    <label for="teacher_id">Select Teacher</label>
    <br>

    <select name="teacher_id" id="teacher_id" required>
        <option value="">-- Select Teacher --</option>
        @foreach ($teachers as $teacher)
            <option value="{{ $teacher->id }}">
                {{ $teacher->name }} ({{ $teacher->email }})
            </option>
        @endforeach
    </select>

    <br><br>

    <button type="submit">Assign Teacher</button>
</form>
