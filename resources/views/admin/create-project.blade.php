<x-layouts.app title="Create Project — Admin">

    <div class="dashboard">

        <div class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">Admin</p>
                <h1>Create New Project</h1>
                <p>Assign a new project to a client.</p>
            </div>
        </div>

        @if(session('success'))
            <x-card>
                <p style="color: #16a34a; font-weight: bold;">
                    {{ session('success') }}
                </p>
            </x-card>
        @endif

        <x-card>

            <form method="POST" action="{{ route('admin.projects.store') }}">
                @csrf

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Client</label>
                    <select name="client_id" required style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                        <option value="">Select a client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Project Name</label>
                    <input type="text" name="name" required style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
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

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Start Date</label>
                    <input type="date" name="start_date" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Due Date</label>
                    <input type="date" name="due_date" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <button type="submit" class="btn btn-success">Create Project</button>

            </form>

        </x-card>

    </div>

</x-layouts.app>