@extends('layouts.admin')

@section('content')

{{-- FLASH MESSAGES --}}
@if(session('success'))
    <div class="mb-4 rounded-lg bg-green-100 px-4 py-2 text-green-800">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 rounded-lg bg-red-100 px-4 py-2 text-red-800">
        {{ session('error') }}
    </div>
@endif

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Students</h1>
    <p class="text-sm text-gray-500">
        Manage student accounts, roles, and academic status
    </p>
</div>

<div class="overflow-x-auto rounded-xl bg-white shadow">
    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-600">
            <tr>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Modules (Status)</th>
                <th class="px-4 py-3 text-left">Role</th>
                <th class="px-4 py-3 text-center">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y">
        @foreach($students as $student)
            <tr>
                <td class="px-4 py-3 font-medium">{{ $student->name }}</td>
                <td class="px-4 py-3">{{ $student->email }}</td>

                {{-- MODULE STATUS --}}
                <td class="px-4 py-3">
                    @forelse($student->modules as $module)
                        <span class="block">
                            {{ $module->module }} —
                            @if($module->pivot->status === 'pass')
                                <span class="text-green-600 font-semibold">PASS</span>
                            @elseif($module->pivot->status === 'fail')
                                <span class="text-red-600 font-semibold">FAIL</span>
                            @else
                                <span class="text-gray-500">ACTIVE</span>
                            @endif
                        </span>
                    @empty
                        <span class="text-gray-400">No modules</span>
                    @endforelse
                </td>

                {{-- ROLE CHANGE --}}
                <td class="px-4 py-3">
                    <form method="POST"
                          action="{{ route('admin.students.updateRole', $student) }}">
                        @csrf
                        @method('PATCH')

                        <select name="role_id"
                                onchange="this.form.submit()"
                                class="rounded-lg border-gray-300 text-sm">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                    @selected($student->role_id === $role->id)>
                                    {{ ucfirst($role->role) }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </td>

                {{-- ACTIONS --}}
                <td class="px-4 py-3 text-center">
                    <form method="POST"
                          action="{{ route('admin.students.destroy', $student) }}"
                          onsubmit="return confirm('Are you sure you want to remove this student?')">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-600 hover:underline">
                            Remove
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection
