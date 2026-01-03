@extends('layouts.admin')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Old Students</h1>
    <p class="text-sm text-gray-500">
        Students who have completed their modules (PASS / FAIL history)
    </p>
</div>

<div class="overflow-x-auto rounded-xl bg-white shadow">
    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Completed Modules</th>
            </tr>
        </thead>

        <tbody class="divide-y">
        @foreach($students as $student)
            <tr>
                <td class="px-4 py-3 font-medium">{{ $student->name }}</td>
                <td class="px-4 py-3">{{ $student->email }}</td>
                <td class="px-4 py-3 space-y-1">
                    @forelse($student->modules as $module)
                        <div>
                            {{ $module->module }} —
                            @if($module->pivot->pass_status === 'pass')
                                <span class="text-green-600 font-semibold">PASS</span>
                            @else
                                <span class="text-red-600 font-semibold">FAIL</span>
                            @endif
                        </div>
                    @empty
                        <span class="text-gray-400">No completed modules</span>
                    @endforelse
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection
