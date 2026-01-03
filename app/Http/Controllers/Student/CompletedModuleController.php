<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompletedModuleController extends Controller
{
    public function index(Request $request)
    {
        // Get search query (optional)
        $search = $request->query('search');

        $completedModules = DB::table('module_user')
            ->join('modules', 'modules.id', '=', 'module_user.module_id')
            ->where('module_user.user_id', auth()->id())
            ->whereNotNull('module_user.completed_at')
            ->when($search, function ($query) use ($search) {
                $query->where('modules.module', 'like', "%{$search}%");
            })
            ->select(
                'modules.module',
                'module_user.completed_at',
                'module_user.pass_status'
            )
            ->orderBy('module_user.completed_at', 'desc')
            ->get();

        return view(
            'student.completed.index',
            compact('completedModules', 'search')
        );
    }
}
