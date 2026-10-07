<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectFile;
use Illuminate\Http\Request;

class ProjectFileController extends Controller
{
    public function create(Project $project)
    {
        $files = $project->files()->latest()->get();

        return view('admin.create-file', compact('project', 'files'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:20480', // 20MB max
        ]);

        $uploaded = $request->file('file');
        $path = $uploaded->store('files', 'public');

        $projectFile = $project->files()->create([
            'uploaded_by' => auth()->id(),
            'original_name' => $uploaded->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $uploaded->getClientMimeType(),
            'file_size' => $uploaded->getSize(),
        ]);

        \App\Models\ActivityLog::record(
            auth()->user()->name . ' uploaded file "' . $projectFile->original_name . '" for ' . $project->name,
            route('admin.files.create', $project)
        );

        return redirect()->route('admin.files.create', $project)
            ->with('success', 'File uploaded successfully.');
    }

    public function destroy(Project $project, ProjectFile $file)
    {
        $fileName = $file->original_name;

        \Storage::disk('public')->delete($file->file_path);
        $file->delete();

        \App\Models\ActivityLog::record(
            auth()->user()->name . ' deleted file "' . $fileName . '" from ' . $project->name,
            route('admin.files.create', $project)
        );

        return redirect()->route('admin.files.create', $project)
            ->with('success', 'File deleted successfully.');
    }
}