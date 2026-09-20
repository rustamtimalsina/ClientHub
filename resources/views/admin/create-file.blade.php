<x-layouts.app title="Files — Admin">

    <div class="dashboard">

        <div class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">Admin</p>
                <h1>{{ $project->name }}</h1>
                <p>Upload and manage files for this project.</p>
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

        <x-card title="Upload File">

            <form method="POST" action="{{ route('admin.files.store', $project) }}" enctype="multipart/form-data">
                @csrf

                <div style="margin-bottom: 16px;">
                    <input type="file" name="file" required style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border); background: white;">
                </div>

                <button type="submit" class="btn btn-success">Upload File</button>

            </form>

        </x-card>

        <x-card title="Existing Files">

            @if($files->isEmpty())
                <x-empty-state
                    title="No files yet"
                    message="Upload one above to get started."
                />
            @else
                <div class="file-list">
                    @foreach($files as $file)
                        <div class="file-item">
                            <div class="file-info">
                                <div class="file-icon">
                                    {{ strtoupper(pathinfo($file->original_name, PATHINFO_EXTENSION)) ?: 'FILE' }}
                                </div>
                                <div>
                                    <strong>{{ $file->original_name }}</strong>
                                    <span>Uploaded {{ $file->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('admin.files.destroy', [$project, $file]) }}" onsubmit="return confirm('Delete this file?');">
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