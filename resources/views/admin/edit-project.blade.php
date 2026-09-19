<x-layouts.app title="Edit Project — Admin">

    <div class="dashboard">

        <div class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">Admin</p>
                <h1>Edit Project</h1>
                <p>Update project details.</p>
            </div>
        </div>

        @if($errors->any())
            <x-card>
                <p style="color: #dc2626; font-weight: bold;">{{ $errors->first() }}</p>
            </x-card>
        @endif

        <x-card>

            <form method="POST" action="{{ route('admin.projects.update', $project) }}">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Client</label>
                    <select name="client_id" required style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" @selected($client->id === $project->client_id)>
                                {{ $client->name }} ({{ $client->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Project Name</label>
                    <input type="text" name="name" required value="{{ old('name', $project->name) }}" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Description</label>
                    <textarea name="description" rows="3" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">{{ old('description', $project->description) }}</textarea>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Status</label>
                    <select name="status" required style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                        <option value="pending" @selected($project->status === 'pending')>Pending</option>
                        <option value="in_progress" @selected($project->status === 'in_progress')>In Progress</option>
                        <option value="completed" @selected($project->status === 'completed')>Completed</option>
                    </select>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Due Date</label>
                    <input type="date" name="due_date" value="{{ old('due_date', $project->due_date?->format('Y-m-d')) }}" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <button type="submit" class="btn btn-success">Save Changes</button>

            </form>

        </x-card>

    </div>

</x-layouts.app>