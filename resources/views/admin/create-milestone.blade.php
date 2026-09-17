<x-layouts.app title="Milestones — Admin">

    <div class="dashboard">

        <div class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">Admin</p>
                <h1>{{ $project->name }}</h1>
                <p>Add and manage milestones for this project.</p>
            </div>
        </div>

        @if(session('success'))
            <x-card>
                <p style="color: #16a34a; font-weight: bold;">{{ session('success') }}</p>
            </x-card>
        @endif

        <x-card title="Add Milestone">

            <form method="POST" action="{{ route('admin.milestones.store', $project) }}">
                @csrf

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Title</label>
                    <input type="text" name="title" required style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Description</label>
                    <textarea name="description" rows="3" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);"></textarea>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Status</label>
                    <select name="status" required style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Add Milestone</button>

            </form>

        </x-card>

        <x-card title="Existing Milestones">

            @if($milestones->isEmpty())
                <x-empty-state
                    title="No milestones yet"
                    message="Add one above to get started."
                />
            @else
                <div class="milestone-list">
                    @foreach($milestones as $milestone)
                        <div class="milestone-card" style="padding: 16px;">
                            <div class="milestone-title">
                                <strong>{{ $milestone->title }}</strong>
                                <x-status-badge :status="$milestone->status" />
                            </div>
                            <p class="milestone-summary">{{ $milestone->description }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

        </x-card>

    </div>

</x-layouts.app>