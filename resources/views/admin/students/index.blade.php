@extends('layouts.admin')

@section('title', 'Students')
@section('header', 'Students')

@section('content')

{{-- HERO (same style as dashboard & modules) --}}
<div class="mb-8 rounded-2xl bg-gradient-to-r from-indigo-600 to-blue-500 p-8 text-white shadow-lg">
    <h2 class="text-3xl font-bold">Students</h2>
    <p class="mt-2 text-indigo-100">
        Manage active students in the system
    </p>
</div>

{{-- CARD --}}
<div class="bg-white rounded-xl shadow-sm overflow-hidden">

    {{-- CARD HEADER --}}
    <div class="flex items-center justify-between px-6 py-4 border-b">
        <h3 class="text-lg font-semibold text-gray-800">
            Student List
        </h3>

        <a href="{{ route('admin.students.create') }}"
           class="inline-flex items-center px-4 py-2 rounded-lg
                  bg-indigo-600 text-white text-sm font-medium
                  hover:bg-indigo-700 transition">
            + Create Student
        </a>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600">
                <tr>
                    <th class="px-6 py-4 text-left font-medium">Name</th>
                    <th class="px-6 py-4 text-left font-medium">Email</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($students as $student)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $student->name }}
                            <span class="ml-2 px-2 py-1 text-xs font-semibold
                                         bg-green-100 text-green-700 rounded">
                                Active
                            </span>
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $student->email }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2"
                            class="px-6 py-6 text-center text-gray-500">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
