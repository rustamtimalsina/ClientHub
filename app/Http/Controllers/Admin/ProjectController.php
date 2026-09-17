<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
       public function index()
    {
        $projects = Project::with('client')->latest()->get();

        return view('admin.projects', compact('projects'));
    }

    public function create()
    {
        $clients = User::where('role', 'client')->get();

        return view('admin.create-project', compact('clients'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date',
        ]);

        Project::create($validated);

        return redirect()->route('admin.projects.create')
            ->with('success', 'Project created successfully.');
    }
}