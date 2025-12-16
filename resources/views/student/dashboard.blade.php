<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body>

    <h1>My Enrolled Modules</h1>

    @if($modules->isEmpty())
        <p>You are not enrolled in any modules yet.</p>
    @else
        <ul>
            @foreach($modules as $module)
                <li>
                    {{ $module->name }}
                </li>
            @endforeach
        </ul>
    @endif

</body>
</html>
