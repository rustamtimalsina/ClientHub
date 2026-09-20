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

        <form method="GET" action="{{ route('admin.projects.index') }}" style="margin-bottom: 20px; display: flex; gap: 10px;">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search by project or client name..."
                style="flex: 1; max-width: 400px; padding: 10px 14px; border-radius: 10px; border: 1px solid var(--border);"
            >
            <button type="submit" class="btn">Search</button>
            @if($search)
                <a href="{{ route('admin.projects.index') }}" class="btn">Clear</a>
            @endif
        </form>

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
                         <a href="{{ route('admin.files.create', $project) }}" class="btn btn-small">
    Manage Files
</a>
<a href="{{ route('admin.milestones.create', $project) }}" class="btn btn-small">
    Manage Milestones
</a>
<a href="{{ route('admin.invoices.create', $project) }}" class="btn btn-small">
    Manage Invoices
</a>
<a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-small">
    Edit
</a>
<form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project? This will also delete all its milestones, files, and invoices. This cannot be undone.');" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-small" style="background: #dc2626; color: white; border: none;">
        Delete
    </button>
</form>
                        </div>
                    @endforeach
                </div>
            @endif

        </x-card>

    </div>

</x-layouts.app>