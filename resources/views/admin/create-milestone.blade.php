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

                            <form method="POST" action="{{ route('admin.milestones.update', [$project, $milestone]) }}">
                                @csrf
                                @method('PUT')

                                <div style="margin-bottom: 12px;">
                                    <input type="text" name="title" required value="{{ $milestone->title }}" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border); font-weight:bold;">
                                </div>

                                <div style="margin-bottom: 12px;">
                                    <textarea name="description" rows="2" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">{{ $milestone->description }}</textarea>
                                </div>

                                <div style="display:flex; gap:10px; align-items:center;">
                                    <select name="status" required style="padding:8px; border-radius:6px; border:1px solid var(--border);">
                                        <option value="pending" @selected($milestone->status === 'pending')>Pending</option>
                                        <option value="in_progress" @selected($milestone->status === 'in_progress')>In Progress</option>
                                        <option value="completed" @selected($milestone->status === 'completed')>Completed</option>
                                    </select>

                                    <button type="submit" class="btn btn-small">Save</button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('admin.milestones.destroy', [$project, $milestone]) }}" onsubmit="return confirm('Delete this milestone?');" style="margin-top: 10px;">
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