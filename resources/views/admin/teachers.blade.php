@extends('layouts.admin')

@section('title', 'Teachers')
@section('header', 'Teachers')

@section('content')

{{-- HERO --}}
<div class="mb-8 rounded-2xl
            bg-gradient-to-r from-slate-900 via-indigo-900 to-blue-900
            p-8 text-white shadow-lg">

    <h2 class="text-3xl font-extrabold tracking-wide">
        Teaching Staff
    </h2>

    <p class="mt-2 text-sm text-indigo-200 max-w-2xl">
        Manage registered teachers, control teaching assignments,
        and maintain accurate academic staffing records.
    </p>
</div>

{{-- Top Action Bar --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h3 class="text-lg font-semibold text-gray-900">
            Teacher List
        </h3>
        <p class="text-sm text-gray-600">
            Active teachers currently registered in the system
        </p>
    </div>

    <a href="{{ route('admin.teachers.create') }}"
       class="inline-flex items-center gap-2 rounded-lg
              bg-indigo-600 px-5 py-2.5
              text-sm font-medium text-white
              shadow hover:bg-indigo-700 transition">
        + Add Teacher
    </a>
</div>

{{-- Teachers Table --}}
@if ($teachers->count())
<div class="overflow-hidden rounded-xl bg-white shadow">

    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
            <tr>
                <th class="px-6 py-4 text-left">Name</th>
                <th class="px-6 py-4 text-left">Email</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @foreach ($teachers as $teacher)
                <tr class="hover:bg-gray-50 transition">

                    {{-- Name --}}
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $teacher->name }}
                    </td>

                    {{-- Email --}}
                    <td class="px-6 py-4 text-gray-700">
                        {{ $teacher->email }}
                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4 text-right">
                        <form method="POST"
                              action="{{ route('admin.teachers.destroy', $teacher) }}"
                              onsubmit="return confirm('Are you sure you want to remove this teacher?');"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex items-center rounded-md
                                       bg-red-100 px-3 py-1.5
                                       text-xs font-semibold text-red-700
                                       hover:bg-red-200 transition">
                                Remove
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@else
<div class="rounded-xl bg-white p-12 text-center shadow">
    <p class="text-gray-500">No teachers found.</p>
</div>
@endif

@endsection
