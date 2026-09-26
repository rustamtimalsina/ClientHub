<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Milestone $milestone)
    {
        $user = Auth::user();

        // Security check: only the client who owns this milestone's project,
        // or any admin, is allowed to comment on it.
        $isOwner = $milestone->project->client_id === $user->id;
        $isAdmin = $user->role === 'admin';

        abort_unless($isOwner || $isAdmin, 403);

        $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $milestone->comments()->create([
            'user_id' => $user->id,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Comment added.');
    }
}