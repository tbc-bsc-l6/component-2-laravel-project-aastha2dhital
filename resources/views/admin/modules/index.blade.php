@extends('layouts.admin')

@section('title', 'Modules')
@section('header', 'Modules')

@section('content')

{{-- HERO --}}
<div class="mb-8 rounded-2xl
            bg-gradient-to-r from-slate-900 via-indigo-900 to-blue-900
            p-8 text-white shadow-lg">

    <h2 class="text-3xl font-extrabold tracking-wide">
        Academic Modules
    </h2>

    <p class="mt-2 text-sm text-indigo-200 max-w-2xl">
        Manage all academic modules offered by the institution.
        Create new modules, activate or deactivate availability,
        assign teachers, and enroll students efficiently.
    </p>
</div>

{{-- Success Message --}}
@if (session('success'))
    <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-800">
        {{ session('success') }}
    </div>
@endif

{{-- Top Action Bar --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h3 class="text-lg font-semibold text-gray-900">
            Module List
        </h3>
        <p class="text-sm text-gray-600">
            Overview of all modules in the system
        </p>
    </div>

    <a href="{{ route('admin.modules.create') }}"
       class="inline-flex items-center gap-2 rounded-lg
              bg-indigo-600 px-5 py-2.5
              text-sm font-medium text-white
              shadow hover:bg-indigo-700 transition">
        + Add Module
    </a>
</div>

{{-- Modules Table --}}
@if ($modules->count())
<div class="overflow-hidden rounded-xl bg-white shadow">

    <table class="w-full text-sm">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
            <tr>
                <th class="px-6 py-4 text-left">Module Name</th>
                <th class="px-6 py-4 text-left">Status</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @foreach ($modules as $module)
                <tr class="hover:bg-gray-50 transition">

                    {{-- Module Name --}}
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $module->module }}
                    </td>

                    {{-- Status --}}
                    <td class="px-6 py-4">
                        <span
                            class="inline-flex items-center rounded-full px-3 py-1
                                   text-xs font-semibold
                                   {{ $module->is_active
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-red-100 text-red-700' }}">
                            {{ $module->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>

                    {{-- Actions --}}
                    <td class="px-6 py-4 text-right space-x-2">

                        <a href="{{ route('admin.modules.enroll-student', $module) }}"
                           class="inline-flex items-center rounded-md px-3 py-1.5
                                  text-xs font-medium
                                  bg-indigo-100 text-indigo-700
                                  hover:bg-indigo-200 transition">
                            Enroll Student
                        </a>

                        <form method="POST"
                              action="{{ route('admin.modules.toggle', $module) }}"
                              class="inline">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="rounded-md px-3 py-1.5 text-xs font-medium
                                       text-indigo-600 hover:bg-indigo-50 transition">
                                Toggle
                            </button>
                        </form>

                        <a href="{{ route('admin.modules.edit', $module) }}"
                           class="text-xs font-medium text-indigo-600
                                  hover:text-indigo-800 underline">
                            Edit / Assign Teacher
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@else
<div class="rounded-xl bg-white p-12 text-center shadow">
    <p class="text-gray-500">No modules found.</p>
</div>
@endif

@endsection
