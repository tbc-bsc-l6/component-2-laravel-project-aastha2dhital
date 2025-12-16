@extends('layouts.app')

@section('content')
<div class="p-6">

    <!-- Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

        <!-- Page Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">
                    Modules
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Manage available modules
                </p>
            </div>

            <a href="#"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                + Add Module
            </a>
        </div>

    </div>
</div>
@endsection
