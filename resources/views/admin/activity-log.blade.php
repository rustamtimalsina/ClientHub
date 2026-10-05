<x-layouts.app title="Activity Log — Admin">

    <div class="dashboard">

        <div class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">Admin</p>
                <h1>Activity Log</h1>
                <p>A running history of actions taken across the platform.</p>
            </div>
        </div>

        <x-card>
            @if($logs->isEmpty())
                <x-empty-state
                    title="No activity yet"
                    message="Actions like creating projects, invoices, and approving milestones will show up here."
                />
            @else
                <div class="activity-timeline">
                    @foreach($logs as $log)
                        <div class="activity-item">
                            <div class="activity-dot"></div>
                            <div class="activity-content">
                                <p class="activity-description">
                                    {{ $log->description }}
                                </p>
                                <span class="activity-time">
                                    {{ $log->created_at->format('M d, Y \a\t g:i A') }}
                                    &middot; {{ $log->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 20px;">
                    {{ $logs->links() }}
                </div>
            @endif
        </x-card>

    </div>

</x-layouts.app>