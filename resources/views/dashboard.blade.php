@php
    $userName = auth()->user()->name ?? 'there';

    $milestones = $project?->milestones ?? collect();
    $files = $project?->files ?? collect();
    $invoices = $project?->invoices ?? collect();

    $totalMilestones = $milestones->count();
    $completedMilestones = $milestones->where('status', 'completed')->count();
    $progress = $totalMilestones > 0
        ? (int) round(($completedMilestones / $totalMilestones) * 100)
        : 0;
@endphp


<x-layouts.app title="Client Dashboard — ClientHub">

    <div class="dashboard">
<div class="dashboard-welcome">
    <div>
        <p class="dashboard-eyebrow">Client Portal</p>
        <h1>Welcome back, {{ $userName }}</h1>
        <p>Here's an overview of your project, milestones, files, and invoices.</p>
    </div>

    <div class="dashboard-date">
        {{ now()->format('M d, Y') }}
    </div>
</div>

@if(!$project)

    <x-card>
        <x-empty-state
            title="No project yet"
            message="You don't have a project assigned yet. Your project manager will set one up soon."
        />
    </x-card>

@else

    @if($allProjects->count() > 1)
        <div style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
            @foreach($allProjects as $p)
                <a
                    href="{{ route('dashboard.project', $p) }}"
                    class="btn btn-small"
                    style="{{ $p->id === $project->id ? 'background: var(--primary); color: white; border-color: var(--primary);' : '' }}"
                >
                    {{ $p->name }}
                </a>
            @endforeach
        </div>
    @endif

{{-- Current Project --}}
<x-card class="current-project-card">

    {{-- Top Section --}}
    <div class="current-project-header">

        <div class="project-title-section">

            <span class="project-label">
                Current Project
            </span>

            <h1 class="current-project-title">
                {{ $project->name }}
            </h1>

            @if($project->description)
                <p class="current-project-description">
                    {{ $project->description }}
                </p>
            @endif

        </div>

        <div class="project-status">
            <x-status-badge :status="$project->status" />
        </div>

    </div>


    {{-- Project Information --}}
    <div class="project-info-grid">

        <div class="project-info-item">

            <span class="info-label">
                Client
            </span>

            <strong>
                {{ $project->client->name ?? 'N/A' }}
            </strong>

        </div>


        <div class="project-info-item">

            <span class="info-label">
                Start Date
            </span>

            <strong>
                {{ $project->start_date?->format('M d, Y') ?? 'Not set' }}
            </strong>

        </div>


        <div class="project-info-item">

            <span class="info-label">
                Due Date
            </span>

            <strong>
                {{ $project->due_date?->format('M d, Y') ?? 'Not set' }}
            </strong>

        </div>

    </div>


    {{-- Progress --}}
    <div class="project-progress-section">

        <div class="progress-header">

            <span>
                Project Progress
            </span>

            <strong>
                {{ $progress }}%
            </strong>

        </div>


        <div class="progress-bar">

            <div
                class="progress-bar-fill"
                style="width: {{ $progress }}%"
            ></div>

        </div>

    </div>

</x-card>
        {{-- Dashboard Grid --}}
        <div class="dashboard-grid">

            {{-- Milestones --}}
            <x-card title="Project Milestones">

                @if(empty($milestones))

                    <x-empty-state
                        title="No milestones yet"
                        message="Milestones will appear here when they are added to the project."
                    />

                @else

                    <div class="milestone-list">

                        @foreach($milestones as $milestone)

                            <details class="milestone-card">

                                {{-- Main Row --}}
                                <summary class="milestone-card-header">

                                    <div class="milestone-main">

                                        <div class="milestone-title">
                                            <strong>
                                                {{ $milestone->title }}
                                            </strong>

                                            <x-status-badge
                                                :status="$milestone->status"
                                            />
                                        </div>

                                        <p class="milestone-summary">
                                            {{ $milestone->description ?? 'No description available.' }}
                                        </p>

                                    </div>


                                    <div class="milestone-actions">
@if($milestone->status !== 'completed')

    <form
        method="POST"
        action="{{ route('milestones.complete', $milestone) }}"
        onsubmit="return confirm('Have you reviewed the submitted work and confirmed that you are satisfied?');"
        style="display: inline;"
    >
        @csrf
        <button type="submit" class="btn btn-success btn-small">
            Mark Complete
        </button>
    </form>

@else

                                            <span class="milestone-completed">
                                                ✓ Completed
                                            </span>

                                        @endif

                                        <span class="milestone-chevron">
                                            ↓
                                        </span>

                                    </div>

                                </summary>


                                {{-- Expanded Details --}}
                                <div class="milestone-card-details">

                                    @if($milestone->completed_at)

                                        <div class="milestone-detail">

                                            <span class="detail-label">
                                                Completed
                                            </span>

                                            <strong>
                                                {{ $milestone->completed_at->format('M d, Y') }}
                                            </strong>

                                        </div>

                                    @endif

                                </div>

                            </details>

                        @endforeach

                    </div>

                @endif

            </x-card>

            {{-- Project Files --}}
            <x-card title="Project Files">

                @if(empty($files))

                    <x-empty-state
                        title="No files available"
                        message="Project files will appear here."
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
                                        <strong>
                                            {{ $file->original_name }}
                                        </strong>

                                        <span>
                                            Uploaded
                                            {{ $file->created_at->format('M d, Y') }}
                                        </span>
                                    </div>

                                </div>

                                <a
                                   
    href="{{ route('files.download', $file) }}"
    class="btn btn-small"
>
    Download
</a>

                            </div>

                        @endforeach

                    </div>

                @endif

            </x-card>

        </div>


        {{-- Invoices --}}
        <x-card title="Invoices">

    @if(empty($invoices))

        <x-empty-state
            title="No invoices yet"
            message="Invoices for your project will appear here."
        />

    @else

        <div class="client-invoice-list">

            @foreach($invoices as $invoice)

                <div class="client-invoice-card">

                    <div class="invoice-card-header">

                        <div>

                            <span class="invoice-number">
                                {{ $invoice->invoice_number }}
                            </span>

                            <p>
                                {{ $project->name }}
                            </p>

                        </div>

                        <x-status-badge
                            :status="$invoice->status"
                        />

                    </div>


                    <div class="invoice-card-details">

                        <div>

                            <span class="invoice-label">
                                Issued
                            </span>

                            <strong>
                                {{ $invoice->issued_at?->format('M d, Y') ?? '—' }}
                            </strong>

                        </div>


                        <div>

                            <span class="invoice-label">
                                Amount
                            </span>

                            <strong class="invoice-amount">
                                NPR {{ number_format($invoice->amount, 2) }}
                            </strong>

                        </div>

                    </div>


                    <div class="invoice-card-actions">

                        <a
                           
    href="{{ route('invoices.download', $invoice) }}"
    class="download-invoice-button"
>
    Download Invoice
</a>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</x-card>

@endif
    </div>

</x-layouts.app>