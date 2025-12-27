@extends('layouts.student')

@section('content')
<div class="max-w-6xl mx-auto">

    <h1 class="text-2xl font-bold mb-1">Completed Modules</h1>
    <p class="text-gray-500 mb-6">
        Your academic history and results
    </p>

    @if($modules->isEmpty())
        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-600">
                You have not completed any modules yet.
            </p>
        </div>
    @else
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left">Module</th>
                        <th class="px-4 py-3 text-left">Enrolled At</th>
                        <th class="px-4 py-3 text-left">Completed At</th>
                        <th class="px-4 py-3 text-left">Result</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($modules as $module)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">
                                {{ $module->module }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ optional($module->pivot->enrolled_at)->format('d M Y') }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ optional($module->pivot->completed_at)->format('d M Y') }}
                            </td>

                            <td class="px-4 py-3">
                                @if(strtolower($module->pivot->pass_status) === 'pass')
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        PASS
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                        FAIL
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
