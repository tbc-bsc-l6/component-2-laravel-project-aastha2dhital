@extends('layouts.student')

@section('title', 'Completed Courses')

@section('content')

<h1 class="text-2xl font-bold mb-6">Completed Courses ✅</h1>

@if($completedModules->isEmpty())
    <div class="bg-white p-6 rounded shadow text-gray-500">
        You have not completed any courses yet.
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($completedModules as $module)
            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold">{{ $module->title }}</h3>
                <p class="text-xs text-gray-500 mt-1">
                    Completed
                </p>
            </div>
        @endforeach
    </div>
@endif

@endsection
