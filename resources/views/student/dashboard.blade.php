@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')

<h2 class="text-3xl font-bold mb-4">My Enrolled Modules</h2>

@if($modules->isEmpty())
    <p class="text-gray-600">You are not enrolled in any modules yet.</p>
@else
    <ul class="space-y-2">
        @foreach($modules as $module)
            <li class="bg-white border p-4 rounded">
                {{ $module->name }}
            </li>
        @endforeach
    </ul>
@endif

@endsection
