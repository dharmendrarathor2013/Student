<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::count();

        return view('dashboard.dashboard', [
            'student' => $student,
        ]);
    }
}
