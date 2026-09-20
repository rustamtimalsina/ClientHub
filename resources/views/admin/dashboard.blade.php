<x-layouts.app title="Admin Dashboard — ClientHub">

    <div class="dashboard">

        <div class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">Admin</p>
                <h1>Overview</h1>
                <p>A snapshot of everything happening across ClientHub.</p>
            </div>
        </div>

        {{-- Stat Cards --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 20px;">

            <x-card>
                <span class="info-label">Total Clients</span>
                <h2 style="margin: 6px 0 0; font-size: 28px;">{{ $stats['total_clients'] }}</h2>
            </x-card>

            <x-card>
                <span class="info-label">Total Projects</span>
                <h2 style="margin: 6px 0 0; font-size: 28px;">{{ $stats['total_projects'] }}</h2>
            </x-card>

            <x-card>
                <span class="info-label">Revenue Collected</span>
                <h2 style="margin: 6px 0 0; font-size: 28px; color: #16a34a;">
                    NPR {{ number_format($stats['total_revenue'], 0) }}
                </h2>
            </x-card>

            <x-card>
                <span class="info-label">Outstanding</span>
                <h2 style="margin: 6px 0 0; font-size: 28px; color: #dc2626;">
                    NPR {{ number_format($stats['outstanding_amount'], 0) }}
                </h2>
            </x-card>

        </div>

        {{-- Project Status Breakdown --}}
        <x-card title="Projects by Status">
            <div style="display: flex; gap: 30px; flex-wrap: wrap;">
                <div>
                    <x-status-badge status="pending" />
                    <strong style="margin-left: 8px;">{{ $stats['pending_projects'] }}</strong>
                </div>
                <div>
                    <x-status-badge status="in_progress" />
                    <strong style="margin-left: 8px;">{{ $stats['in_progress_projects'] }}</strong>
                </div>
                <div>
                    <x-status-badge status="completed" />
                    <strong style="margin-left: 8px;">{{ $stats['completed_projects'] }}</strong>
                </div>
                @if($stats['overdue_invoices'] > 0)
                    <div>
                        <x-status-badge status="overdue" />
                        <strong style="margin-left: 8px;">{{ $stats['overdue_invoices'] }} invoice(s)</strong>
                    </div>
                @endif
            </div>
        </x-card>

        {{-- Recent Projects --}}
        <x-card title="Recent Projects">

            @if($recentProjects->isEmpty())
                <x-empty-state
                    title="No projects yet"
                    message="Create your first project to get started."
                />
            @else
                <div class="file-list">
                    @foreach($recentProjects as $project)
                        <div class="file-item">
                            <div>
                                <strong>{{ $project->name }}</strong>
                                <span>Client: {{ $project->client->name ?? 'N/A' }}</span>
                            </div>
                            <x-status-badge :status="$project->status" />
                        </div>
                    @endforeach
                </div>
            @endif

        </x-card>

        <div style="margin-top: 10px;">
            <a href="{{ route('admin.projects.index') }}" class="btn">View All Projects →</a>
        </div>

    </div>

</x-layouts.app>