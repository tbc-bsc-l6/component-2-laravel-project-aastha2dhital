@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto text-center py-20">
    <h1 class="text-3xl font-bold text-red-600">403 Forbidden</h1>
    <p class="mt-4">You are not allowed to access this page.</p>
    <a href="{{ route('dashboard') }}" class="text-blue-600 underline mt-4 block">
        Go back to dashboard
    </a>
</div>
@endsection
