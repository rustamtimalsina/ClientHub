<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(30);

        ActivityLog::where('is_read', false)->update(['is_read' => true]);

        return view('admin.activity-log', compact('logs'));
    }

    public function markRead()
    {
        ActivityLog::where('is_read', false)->update(['is_read' => true]);

        return back();
    }
}