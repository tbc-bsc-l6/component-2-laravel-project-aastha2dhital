<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function dashboard()
    {
       if (auth()->user()->role->name !== 'admin') {
       abort(403);
       }
    return view('admin.dashboard');
    }

    public function modules()
    {
        return view('admin.modules.index');
    }

    public function teachers()
    {
        return view('admin.teachers');
    }

    public function students()
    {
        return view('admin.students');
    }
}
