@extends('layouts.student')

@section('title', 'Completed Modules')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold">Completed Modules</h1>
    <p class="text-sm text-gray-500 mt-1">
        This page shows all modules you have completed.
    </p>
</div>

@if($completedModules->isEmpty())
    <div class="bg-white p-6 rounded shadow text-gray-500">
        You have not completed any modules yet.
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($completedModules as $module)
            <div class="bg-white rounded-lg shadow p-5">
                <h2 class="text-lg font-semibold">
                    {{ $module->name }}
                </h2>

                <p class="mt-2 text-sm">
                    Status:
                    <span class="{{ $module->pivot->pass_status === 'PASS'
                        ? 'text-green-600 font-semibold'
                        : 'text-red-600 font-semibold' }}">
                        {{ $module->pivot->pass_status }}
                    </span>
                </p>

                <p class="text-xs text-gray-500 mt-1">
                    Completed on:
                    {{ \Carbon\Carbon::parse($module->pivot->completed_at)->format('d M Y') }}
                </p>
            </div>
        @endforeach
    </div>
@endif

@endsection
