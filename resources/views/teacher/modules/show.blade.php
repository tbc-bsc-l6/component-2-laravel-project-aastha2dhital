\@extends('layouts.teacher')

@section('content')

<div class="mb-8">
    <h2 class="text-xl font-semibold text-slate-800">
        Students – {{ $module->module }}
    </h2>
    <p class="text-sm text-slate-500">
        Active students enrolled in this module
    </p>
</div>

<form method="GET" class="mb-6 max-w-md flex gap-2">
    <input
        type="text"
        name="search"
        value="{{ $search }}"
        placeholder="Search student..."
        class="flex-1 rounded-lg border border-slate-300 px-4 py-2 text-sm"
    >
    <button class="rounded-lg bg-slate-800 px-4 py-2 text-sm text-white">
        Search
    </button>
</form>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">

    <div class="grid grid-cols-4 gap-4 px-6 py-4 text-sm font-semibold bg-slate-100">
        <div>Name</div>
        <div>Email</div>
        <div>Enrolled On</div>
        <div class="text-right">Action</div>
    </div>

    @forelse($students as $student)

        <div class="grid grid-cols-4 gap-4 px-6 py-4 border-t items-center">

            <div class="font-medium">
                {{ $student->name }}
            </div>

            <div class="text-sm text-slate-600">
                {{ $student->email }}
            </div>

            <div class="text-sm text-slate-600">
                {{ $student->pivot->created_at->format('d M Y') }}
            </div>

            <div class="flex justify-end gap-2">

                <!-- PASS -->
                <form method="POST"
                      action="{{ route('teacher.modules.grade', [$module->id, $student->id]) }}">
                    @csrf
                    <input type="hidden" name="pass_status" value="pass">
                    <button class="px-3 py-1 rounded bg-green-600 text-white text-sm">
                        Pass
                    </button>
                </form>

                <!-- FAIL -->
                <form method="POST"
                      action="{{ route('teacher.modules.grade', [$module->id, $student->id]) }}">
                    @csrf
                    <input type="hidden" name="pass_status" value="fail">
                    <button class="px-3 py-1 rounded bg-red-600 text-white text-sm">
                        Fail
                    </button>
                </form>

            </div>
        </div>

    @empty
        <div class="px-6 py-10 text-center text-slate-500">
            No active students enrolled.
        </div>
    @endforelse

</div>

@endsection
