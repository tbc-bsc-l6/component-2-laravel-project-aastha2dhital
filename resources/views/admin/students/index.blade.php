@extends('layouts.admin')

@section('title', 'Students')
@section('header', 'Students')

@section('content')

{{-- HERO --}}
<div class="mb-8 rounded-2xl
            bg-gradient-to-r from-slate-900 via-indigo-900 to-blue-900
            p-8 text-white shadow-lg">

    <h2 class="text-3xl font-extrabold tracking-wide">
        Active Students
    </h2>

    <p class="mt-2 text-sm text-indigo-200 max-w-2xl">
        View and manage all currently enrolled students.
        Monitor student accounts, enrollment status, and
        maintain accurate academic records.
    </p>
</div>

{{-- Top Action Bar --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h3 class="text-lg font-semibold text-gray-900">
            Student List
        </h3>
        <p class="text-sm text-gray-600">
            Registered and active students in the system
        </p>
    </div>

    <a href="{{ route('admin.students.create') }}"
       class="inline-flex items-center gap-2 rounded-lg
              bg-indigo-600 px-5 py-2.5
              text-sm font-medium text-white
              shadow hover:bg-indigo-700 transition">
        + Create Student
    </a>
</div>

{{-- Students Table --}}
@if ($students->count())
<div class="overflow-hidden rounded-xl bg-white shadow">

    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
            <tr>
                <th class="px-6 py-4 text-left">Name</th>
                <th class="px-6 py-4 text-left">Email</th>
                <th class="px-6 py-4 text-left">Status</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @foreach ($students as $student)
                <tr class="hover:bg-gray-50 transition">

                    {{-- Name --}}
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $student->name }}
                    </td>

                    {{-- Email --}}
                    <td class="px-6 py-4 text-gray-700">
                        {{ $student->email }}
                    </td>

                    {{-- Status --}}
                    <td class="px-6 py-4">
                        <span
                            class="inline-flex items-center rounded-full px-3 py-1
                                   text-xs font-semibold
                                   bg-green-100 text-green-700">
                            Active
                        </span>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@else
<div class="rounded-xl bg-white p-12 text-center shadow">
    <p class="text-gray-500">No students found.</p>
</div>
@endif

@endsection
