@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-8">

        <h2 class="font-semibold text-xl text-gray-800 mb-4">
            Available Modules
        </h2>

        {{-- Success / Error Messages --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Modules List --}}
        <div class="bg-white shadow rounded-lg divide-y">
            @forelse ($modules as $module)
                <div class="p-4 flex justify-between items-center">
                    <div>
                        <p class="font-medium">{{ $module->module }}</p>
                        <p class="text-sm text-gray-500">
                            {{ $module->activeStudentCount() }} / 10 students
                        </p>
                    </div>

                    <form method="POST"
                          action="{{ route('student.modules.enroll', $module) }}">
                        @csrf
                        <button
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Enroll
                        </button>
                    </form>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500">
                    No modules available for enrollment.
                </div>
            @endforelse
        </div>

    </div>
@endsection
