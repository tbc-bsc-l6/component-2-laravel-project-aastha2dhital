@extends('layouts.student')

@section('title', 'My Modules')

@section('content')

{{-- HEADER --}}
<div class="mb-8 p-6 rounded-xl
            bg-gradient-to-r from-indigo-700 to-purple-700
            text-white shadow-lg">

    <h1 class="text-2xl font-bold">
        Ready to learn, {{ auth()->user()->name }}? 👋
    </h1>

    <p class="text-sm mt-1 text-white/90">
        You can enroll in up to <span class="font-semibold">4 active modules</span>.
        Each module allows <span class="font-semibold">10 students</span>.
    </p>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('student.modules.index') }}" class="mt-4">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search modules (Database, Networking...)"
            class="w-full sm:w-1/2 rounded-lg px-4 py-2 text-sm
                   text-gray-900 placeholder-gray-500
                   focus:outline-none focus:ring-2 focus:ring-indigo-300"
        >
    </form>
</div>

{{-- FLASH MESSAGES --}}
@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
        {{ session('error') }}
    </div>
@endif

{{-- MODULE GRID --}}
@if($modules->count() === 0)

    <div class="bg-white p-6 rounded-xl text-center text-gray-500 shadow">
        No modules available.
    </div>

@else

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

@foreach($modules as $module)

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm
                p-4 flex flex-col justify-between
                hover:shadow-md transition">

        {{-- MODULE NAME (FIXED & VISIBLE) --}}
        <div>
            <h3 class="text-base font-bold text-gray-900 leading-tight">
                {{ $module->module }}
            </h3>

            <p class="text-xs text-gray-600 mt-1">
                👥 {{ $module->users_count }} / {{ $module->max_students }} enrolled
            </p>
        </div>

        {{-- ACTION --}}
        <div class="mt-4">
            @if($module->already_enrolled)
                <span class="inline-block text-xs font-semibold text-green-600">
                    Enrolled ✔
                </span>

            @elseif($module->is_full)
                <span class="inline-block text-xs font-semibold text-red-500">
                    Module full
                </span>

            @else
                <form method="POST" action="{{ route('student.modules.enroll', $module) }}">
                    @csrf
                    <button
                        class="w-full bg-indigo-600 hover:bg-indigo-700
                               text-white text-xs font-medium
                               py-1.5 rounded-md transition">
                        Enroll
                    </button>
                </form>
            @endif
        </div>

    </div>

@endforeach

</div>
@endif

@endsection
