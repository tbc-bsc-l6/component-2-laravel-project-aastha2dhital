@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')

<!-- ================= GRADIENT HEADER ================= -->
<div class="relative mb-8 overflow-hidden rounded-2xl shadow">
    <div class="relative h-32 md:h-36">

        <!-- Gradient -->
        <div class="absolute inset-0 bg-[linear-gradient(110deg,#2563eb_0%,#1e40af_40%,#020617_100%)]"></div>

        <!-- Glow -->
        <div class="absolute -left-24 -bottom-24 h-[260px] w-[260px]
                    bg-[radial-gradient(circle_at_center,rgba(96,165,250,0.45)_0%,rgba(96,165,250,0)_60%)]
                    blur-3xl"></div>

        <div class="relative z-10 flex h-full items-center px-8">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    Welcome back, {{ auth()->user()->name }} 👋
                </h1>
                <p class="mt-1 text-sm text-white/80">
                    Access your enrolled modules and track your progress
                </p>
            </div>
        </div>
    </div>
</div>

<!-- ================= DASHBOARD CARDS ================= -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

    <!-- Enrolled Modules -->
    <div class="rounded-2xl bg-white p-6 shadow border border-slate-200">
        <h3 class="text-lg font-semibold text-slate-800 mb-2">
            📘 Enrolled Modules
        </h3>
        <p class="text-sm text-slate-500 mb-4">
            View modules you are currently enrolled in.
        </p>
        <a href="{{ route('student.modules.index') }}"
           class="inline-block rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
            View Modules →
        </a>
    </div>

    <!-- Completed Courses -->
    <div class="rounded-2xl bg-white p-6 shadow border border-slate-200">
        <h3 class="text-lg font-semibold text-slate-800 mb-2">
            ✅ Completed Courses
        </h3>
        <p class="text-sm text-slate-500 mb-4">
            See modules you have successfully completed.
        </p>
        <a href="{{ route('student.completed') }}"
           class="inline-block rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700 transition">
            View Completed →
        </a>
    </div>

    <!-- Profile -->
    <div class="rounded-2xl bg-white p-6 shadow border border-slate-200">
        <h3 class="text-lg font-semibold text-slate-800 mb-2">
            👤 My Profile
        </h3>
        <p class="text-sm text-slate-500 mb-4">
            Manage your personal details and account info.
        </p>
        <a href="{{ route('profile.edit') }}"
           class="inline-block rounded-lg bg-slate-800 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-900 transition">
            Edit Profile →
        </a>
    </div>

</div>

@endsection
