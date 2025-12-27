@extends('layouts.admin')

@section('title', 'Create Module')
@section('header', 'Create Module')

@section('content')

<div class="max-w-xl bg-white rounded-xl shadow p-8">
    <h2 class="text-xl font-semibold mb-6">Add New Module</h2>

    @error('module')
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
            {{ $message }}
        </div>
    @enderror

    <form method="POST" action="{{ route('admin.modules.store') }}">
        @csrf

        <label class="block mb-2 text-sm font-medium">Module Name</label>
        <input type="text"
               name="module"
               value="{{ old('module') }}"
               class="w-full border rounded px-4 py-2 mb-6">

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.modules.index') }}" class="px-4 py-2 border rounded">
                Cancel
            </a>
            <button class="px-5 py-2 bg-indigo-600 text-white rounded">
                Create Module
            </button>
        </div>
    </form>
</div>

@endsection
