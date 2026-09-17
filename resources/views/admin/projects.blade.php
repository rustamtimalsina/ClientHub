<x-layouts.app title="Projects — Admin">

    <div class="dashboard">

        <div class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">Admin</p>
                <h1>All Projects</h1>
                <p>Select a project to manage its milestones.</p>
            </div>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-success">+ New Project</a>
        </div>

        <x-card>

            @if($projects->isEmpty())
                <x-empty-state
                    title="No projects yet"
                    message="Create your first project to get started."
                />
            @else
                <div class="file-list">
                    @foreach($projects as $project)
                        <div class="file-item">
                            <div>
                                <strong>{{ $project->name }}</strong>
                                <span>Client: {{ $project->client->name ?? 'N/A' }}</span>
                            </div>
                            <a href="{{ route('admin.milestones.create', $project) }}" class="btn btn-small">
                                Manage Milestones
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

        </x-card>

    </div>

</x-layouts.app>