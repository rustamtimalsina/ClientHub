<?php

namespace App\Http\Controllers;

use App\Mail\MilestoneCompletedMail;
use App\Models\Milestone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MilestoneController extends Controller
{
    public function complete(Milestone $milestone)
    {
        abort_unless(
            $milestone->project->client_id === Auth::id(),
            403
        );

        $milestone->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        Mail::to($milestone->project->client->email)
            ->send(new MilestoneCompletedMail($milestone));

        return back()->with('success', 'Milestone marked as complete.');
    }
}