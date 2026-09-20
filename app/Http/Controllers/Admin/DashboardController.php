<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_clients' => User::where('role', 'client')->count(),
            'total_projects' => Project::count(),
            'pending_projects' => Project::where('status', 'pending')->count(),
            'in_progress_projects' => Project::where('status', 'in_progress')->count(),
            'completed_projects' => Project::where('status', 'completed')->count(),
            'total_revenue' => Invoice::where('status', 'paid')->sum('amount'),
            'outstanding_amount' => Invoice::whereIn('status', ['pending', 'overdue'])->sum('amount'),
            'overdue_invoices' => Invoice::where('status', 'overdue')->count(),
        ];

        $recentProjects = Project::with('client')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects'));
    }
}