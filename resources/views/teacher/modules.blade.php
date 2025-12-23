@extends('layouts.teacher')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">
            My Modules
        </h2>

        @if($modules->count())
            <ul class="list-disc pl-6">
                @foreach($modules as $module)
                    <li class="mb-2">
                        {{ $module->name }}
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">
                No modules assigned yet.
            </p>
        @endif
    </div>
@endsection
