<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $activities = ActivityLog::latest()->with('user')->take(50)->get();

        return view('dashboard.index', compact('activities'));
    }

}
