@extends('layouts.admin')

@section('title', 'Modules')
@section('header', 'Modules')

@section('content')

{{-- HERO --}}
<div class="mb-8 rounded-2xl bg-gradient-to-r from-indigo-700 to-blue-600 p-8 text-white shadow-lg">
    <h2 class="text-3xl font-bold">Modules</h2>
    <p class="mt-2 text-indigo-100">
        Create and manage academic modules
    </p>
</div>

@if (session('success'))
    <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-800">
        {{ session('success') }}
    </div>
@endif

<div class="mb-6 flex items-center justify-between">
    <div>
        <h3 class="text-lg font-semibold text-gray-900">Module List</h3>
        <p class="text-sm text-gray-600">Manage system modules</p>
    </div>

    <a href="{{ route('admin.modules.create') }}"
       class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-700">
        + Add Module
    </a>
</div>

@if ($modules->count())
<div class="overflow-hidden rounded-xl bg-white shadow-sm">
    <table class="w-full text-sm text-gray-900">
        <thead class="bg-gray-50 text-xs uppercase text-gray-700">
            <tr>
                <th class="px-6 py-4 text-left">Module Name</th>
                <th class="px-6 py-4 text-left">Status</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
        @foreach ($modules as $module)
            <tr class="hover:bg-gray-50">

                {{-- ✅ FIXED MODULE NAME --}}
                <td class="px-6 py-4 font-semibold text-gray-900">
                    {{ $module->name ?? $module->module_name ?? $module->title ?? '—' }}
                </td>

                <td class="px-6 py-4">
                    <span class="rounded-full px-3 py-1 text-xs font-medium
                        {{ $module->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $module->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>

                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.modules.enroll-student', $module) }}"
                       class="rounded bg-indigo-100 px-3 py-1.5 text-xs text-indigo-700 hover:bg-indigo-200">
                        Enroll Student
                    </a>

                    <form method="POST" action="{{ route('admin.modules.toggle', $module) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button class="px-3 py-1.5 text-xs text-indigo-600 hover:bg-indigo-50 rounded">
                            Toggle
                        </button>
                    </form>

                    <a href="{{ route('admin.modules.edit', $module) }}"
                       class="text-xs text-indigo-600 underline hover:text-indigo-800">
                        Edit / Assign Teacher
                    </a>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection
