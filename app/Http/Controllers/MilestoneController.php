<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Support\Facades\Auth;

class MilestoneController extends Controller
{
    public function complete(Milestone $milestone)
    {
        // Security check: only the client who owns this milestone's
        // project is allowed to mark it complete.
        abort_unless(
            $milestone->project->client_id === Auth::id(),
            403
        );

        $milestone->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        return back()->with('success', 'Milestone marked as complete.');
    }
}