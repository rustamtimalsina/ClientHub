<?php

namespace App\Http\Controllers;

use App\Models\ProjectFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectFileController extends Controller
{
    public function download(ProjectFile $projectFile)
    {
        abort_unless(
            $projectFile->project->client_id === Auth::id(),
            403
        );

        abort_unless(
            Storage::disk('public')->exists($projectFile->file_path),
            404,
            'File not found in storage.'
        );

        return Storage::disk('public')->download(
            $projectFile->file_path,
            $projectFile->original_name
        );
    }
}