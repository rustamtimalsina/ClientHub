<x-layouts.app title="Account Settings — ClientHub">

    <div class="dashboard">

        <div class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">Account</p>
                <h1>Account Settings</h1>
                <p>Update your name or change your password.</p>
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

        <x-card title="Profile">

            <form method="POST" action="{{ route('account.update') }}">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Name</label>
                    <input type="text" name="name" required value="{{ old('name', auth()->user()->name) }}" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Email</label>
                    <input type="text" value="{{ auth()->user()->email }}" disabled style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border); background: #f3f4f6; color: var(--muted);">
                </div>

                <hr style="border: none; border-top: 1px solid var(--border); margin: 24px 0;">

                <p style="font-weight: bold; margin-bottom: 12px;">Change Password (optional)</p>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Current Password</label>
                    <input type="password" name="current_password" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">New Password</label>
                    <input type="password" name="password" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Confirm New Password</label>
                    <input type="password" name="password_confirmation" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <button type="submit" class="btn btn-success">Save Changes</button>

            </form>

        </x-card>

    </div>

</x-layouts.app>