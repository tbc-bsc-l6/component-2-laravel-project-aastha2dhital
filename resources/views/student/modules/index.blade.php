@extends('layouts.student')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Available Modules</h1>

    @if($modules->isEmpty())
        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-600">
                No modules available for enrolment.
            </p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($modules as $module)
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
                            class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
                            Enrol
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
@endsection
