<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function create(Project $project)
    {
        $milestones = $project->milestones()->latest()->get();

        return view('admin.create-milestone', compact('project', 'milestones'));
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $validated['completed_at'] = $validated['status'] === 'completed'
            ? now()
            : null;

        $project->milestones()->create($validated);

        return redirect()->route('admin.milestones.create', $project)
            ->with('success', 'Milestone added successfully.');
    }
}