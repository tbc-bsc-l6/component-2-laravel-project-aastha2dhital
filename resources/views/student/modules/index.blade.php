@extends('layouts.student')

@section('content')
<div class="max-w-6xl mx-auto">

    {{-- PAGE HEADER --}}
    <h1 class="text-2xl font-bold mb-1">Available Modules</h1>
    <p class="text-gray-500 mb-6">
        You can enroll in a maximum of <strong>4</strong> active modules at a time.
    </p>

    {{-- FLASH MESSAGES --}}
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @php
        $activeCount = auth()->user()
            ->modules()
            ->wherePivotNull('completed_at')
            ->count();
    @endphp

    {{-- NO MODULES AVAILABLE --}}
    @if($modules->isEmpty())
        <div class="bg-white p-6 rounded shadow">
            @if($activeCount >= 4)
                <p class="text-red-600 font-medium">
                    You have reached the maximum limit of 4 active modules.
                </p>
            @else
                <p class="text-gray-600">
                    No new modules are available for enrolment at this time.
                </p>
            @endif
        </div>

    {{-- MODULE LIST --}}
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($modules as $module)
                @php
                    $isLimitReached = $activeCount >= 4;
                @endphp

                <div class="bg-white p-6 rounded shadow flex flex-col">

                    <h2 class="text-lg font-semibold mb-2">
                        {{ $module->module }}
                    </h2>

                    <p class="text-sm text-gray-600 mb-4">
                        {{ $module->description }}
                    </p>

                    <form method="POST"
                          action="{{ route('student.modules.enroll', $module) }}"
                          class="mt-auto">
                        @csrf

                        <button
                            type="submit"
                            class="w-full py-2 rounded font-medium
                                {{ $isLimitReached
                                    ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                                    : 'bg-indigo-600 text-white hover:bg-indigo-700' }}"
                            {{ $isLimitReached ? 'disabled' : '' }}>
                            
                            {{ $isLimitReached ? 'Limit Reached' : 'Enrol' }}
                        </button>
                    </form>

                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
