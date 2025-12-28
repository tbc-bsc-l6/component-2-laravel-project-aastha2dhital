@extends('layouts.admin')

@section('title', 'Old Students')
@section('header', 'Old Students')

@section('content')

{{-- HERO (MATCHES MODULES / TEACHERS EXACTLY) --}}
<div class="mb-8 rounded-2xl
            bg-gradient-to-r from-slate-900 via-indigo-900 to-blue-900
            p-8 text-white shadow-lg">

    <h1 class="text-3xl font-extrabold text-white">
        Old Students
    </h1>

    <p class="mt-2 text-sm text-indigo-200 max-w-2xl">
        Students who have completed or left all assigned modules.
        These records are preserved for academic history and reporting purposes.
    </p>
</div>

{{-- CONTENT CARD --}}
<div class="rounded-xl bg-white shadow">

    {{-- HEADER --}}
    <div class="border-b px-6 py-4">
        <h2 class="text-lg font-semibold text-gray-800">
            Student Records
        </h2>
        <p class="text-sm text-gray-500">
            Archived students with no active module enrollments
        </p>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-left">Email</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse ($students as $student)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $student->name }}
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $student->email }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-8 text-center text-gray-500">
                            No old students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
