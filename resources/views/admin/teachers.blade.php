<h1>Teachers</h1>
<ul>
    @foreach ($teachers as $teacher)
        <li>{{ $teacher->name }} ({{ $teacher->email }})</li>
    @endforeach
</ul>

