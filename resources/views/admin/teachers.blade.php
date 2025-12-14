<h1>Teachers</h1>

<ul>
@foreach($teachers as $teacher)
    <li>
        {{ $teacher->name }} ({{ $teacher->email }})

        <form method="POST" action="/admin/teachers/{{ $teacher->id }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </li>
@endforeach
</ul>
