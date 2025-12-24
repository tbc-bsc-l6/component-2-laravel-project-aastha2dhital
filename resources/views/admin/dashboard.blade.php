@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('header', 'Admin Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm text-gray-500">Total Modules</h3>
            <p class="text-2xl font-bold mt-2">—</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm text-gray-500">Total Teachers</h3>
            <p class="text-2xl font-bold mt-2">—</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm text-gray-500">Total Students</h3>
            <p class="text-2xl font-bold mt-2">—</p>
        </div>

    </div>
@endsection
