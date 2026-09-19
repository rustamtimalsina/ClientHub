<x-layouts.app title="Clients — Admin">

    <div class="dashboard">

        <div class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">Admin</p>
                <h1>Client Accounts</h1>
                <p>Create login accounts for your clients.</p>
            </div>
        </div>

        @if(session('success'))
            <x-card>
                <p style="color: #16a34a; font-weight: bold;">{{ session('success') }}</p>
            </x-card>
        @endif

        @if($errors->any())
            <x-card>
                <p style="color: #dc2626; font-weight: bold;">{{ $errors->first() }}</p>
            </x-card>
        @endif

        <x-card title="Add Client">

            <form method="POST" action="{{ route('admin.clients.store') }}">
                @csrf

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Full Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Password</label>
                    <input type="password" name="password" required minlength="8" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <button type="submit" class="btn btn-success">Create Client</button>

            </form>

        </x-card>

        <x-card title="Existing Clients">

            @if($clients->isEmpty())
                <x-empty-state
                    title="No clients yet"
                    message="Add one above to get started."
                />
            @else
                <div class="file-list">
                    @foreach($clients as $client)
                        <div class="file-item">
                            <div>
                                <strong>{{ $client->name }}</strong>
                                <span>{{ $client->email }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </x-card>

    </div>

</x-layouts.app>