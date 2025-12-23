@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold mb-4">My Modules</h2>

        @if ($modules->isEmpty())
            <p>You are not enrolled in any modules yet.</p>
        @else
            <ul class="list-disc pl-6">
                @foreach ($modules as $module)
                    <li>{{ $module->name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
