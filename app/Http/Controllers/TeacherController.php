<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Teacher dashboard
     */
    public function index()
    {
        return redirect()->route('teacher.modules.index');
    }
}
