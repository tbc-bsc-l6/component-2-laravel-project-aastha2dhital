<x-admin-layout title="Dashboard">

    <div class="max-w-6xl mx-auto space-y-6">

        <div class="card-strong p-10 text-center">
            <h1 class="text-3xl font-black text-slate-900">
                Welcome, {{ auth()->user()->name }}
            </h1>
            <p class="text-slate-600 mt-2 font-medium">
                Choose a section to manage the system
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Modules --}}
            <a href="{{ route('admin.modules.index') }}" class="tile group">
                <div class="tile-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                        <path d="M4 19.5V6.5C4 5.12 5.12 4 6.5 4H20V20H6.5C5.12 20 4 18.88 4 17.5V17.5" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <path d="M8 7H18" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <path d="M8 11H18" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="mt-4 font-black text-slate-900 text-lg">Modules</div>
                <div class="text-slate-600 text-sm font-medium">Create & manage modules</div>
            </a>

            {{-- Students --}}
            <a href="{{ route('admin.students.index') }}" class="tile group">
                <div class="tile-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <path d="M9.5 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="white" stroke-width="2"/>
                        <path d="M22 21v-2a3 3 0 0 0-2.2-2.9" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <path d="M17.8 4.1a4 4 0 0 1 0 7.8" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="mt-4 font-black text-slate-900 text-lg">Students</div>
                <div class="text-slate-600 text-sm font-medium">Enrollments & status</div>
            </a>

            {{-- Teachers --}}
            <a href="{{ route('admin.teachers.index') }}" class="tile group">
                <div class="tile-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                        <path d="M12 3 1 9l11 6 9-4.9V17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3 11v6c0 1.7 3.6 3 9 3s9-1.3 9-3v-6" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="mt-4 font-black text-slate-900 text-lg">Teachers</div>
                <div class="text-slate-600 text-sm font-medium">Staff & assignments</div>
            </a>

            {{-- Old Students --}}
            <a href="{{ route('admin.students.old') }}" class="tile group">
                <div class="tile-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                        <path d="M3 12a9 9 0 1 0 3-6.7" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <path d="M3 4v5h5" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        <path d="M12 7v6l4 2" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="mt-4 font-black text-slate-900 text-lg">Old Students</div>
                <div class="text-slate-600 text-sm font-medium">PASS/FAIL history</div>
            </a>

        </div>

    </div>

</x-admin-layout>
