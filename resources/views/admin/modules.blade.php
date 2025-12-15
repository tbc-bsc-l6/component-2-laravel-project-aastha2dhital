<h1>Modules</h1>

<a href="/admin/modules/create">Add Module</a>

<ul>
@foreach($modules as $module)
    <li>{{ $module->name }}</li>
@endforeach
</ul>
