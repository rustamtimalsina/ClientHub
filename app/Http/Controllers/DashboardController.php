<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // NEW: also load the project's milestones, files, and invoices
        // in one go, instead of just the bare project.
        $project = $user?->projects()
            ->with(['milestones', 'files', 'invoices'])
            ->first();

        return view('dashboard', compact('project'));
    }
}