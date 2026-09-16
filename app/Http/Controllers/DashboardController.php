<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $project = $user?->projects()->first();

        return view('dashboard', compact('project'));
    }
}