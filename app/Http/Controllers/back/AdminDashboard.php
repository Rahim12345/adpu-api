<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;

class AdminDashboard extends Controller
{
    public function dashboard()
    {
        return view('back.pages.dashboard.dashboard');
    }
}
