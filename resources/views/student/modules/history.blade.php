@extends('layouts.student')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Completed Modules</h1>

    @if($modules->isEmpty())
        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-600">
                You have not completed any modules yet.
            </p>
        </div>
    @else
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Module</th>
                        <th class="px-4 py-2 text-left">Completed On</th>
                        <th class="px-4 py-2 text-left">Result</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($modules as $module)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $module->module }}</td>
                            <td class="px-4 py-2">
                                {{ $module->pivot->completed_at }}
                            </td>
                            <td class="px-4 py-2 font-semibold">
                                {{ strtoupper($module->pivot->pass_status) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
