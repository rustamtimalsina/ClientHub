<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
       public function index(?Project $project = null)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $allProjects = $user?->projects()->latest()->get() ?? collect();
        if ($project) {
            // Security check: make sure this project actually belongs to the logged-in client
            abort_unless($project->client_id === $user->id, 403);
        } else {
            $project = $allProjects->first();
        }

        if ($project) {
            $project->load(['milestones', 'files', 'invoices']);
        }

        return view('dashboard', [
            'project' => $project,
            'allProjects' => $allProjects,
        ]);
    }
}