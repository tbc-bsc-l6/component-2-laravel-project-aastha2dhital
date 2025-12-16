<h1>Modules</h1>

<a href="/admin/modules/create">Add Module</a>

<ul>
@foreach($modules as $module)
    <li>
            {{ $module->name }}

            | <a href="/admin/modules/{{ $module->id }}/assign">
                Assign Teacher
              </a>

            | <a href="/admin/modules/{{ $module->id }}/enroll">
                Enroll Student
              </a>
        </li>
@endforeach
</ul>
