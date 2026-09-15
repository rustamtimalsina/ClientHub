@php
    /*
    |--------------------------------------------------------------------------
    | Static Demo Data
    |--------------------------------------------------------------------------
    | No database, authentication, models, or relationships are required.
    */

    $userName = 'John Doe';

    $project = (object) [
        'name' => 'ClientHub Website',
        'description' => 'Design and development of the new ClientHub website.',
        'status' => 'in_progress',
        'clientName' => 'John Doe',
        'startDate' => 'Aug 01, 2026',
        'dueDate' => 'Sep 30, 2026',
        'progress' => 65,
    ];

    $milestones = [
        (object) [
            'title' => 'UI/UX Design',
            'description' => 'Complete the user interface and user experience designs.',
            'status' => 'completed',
            'dueDate' => 'Aug 10, 2026',
            'completedAt' => 'Aug 10, 2026',
            'reviewUrl' => '#',
        ],
        (object) [
            'title' => 'Frontend Development',
            'description' => 'Build the responsive frontend based on the approved designs.',
            'status' => 'in_progress',
            'dueDate' => 'Aug 30, 2026',
            'completedAt' => null,
            'reviewUrl' => '#',
        ],
        (object) [
            'title' => 'Backend Integration',
            'description' => 'Connect the frontend with the required backend services.',
            'status' => 'pending',
            'dueDate' => 'Sep 15, 2026',
            'completedAt' => null,
            'reviewUrl' => null,
        ],
    ];

    $files = [
        (object) [
            'originalName' => 'project-requirements.pdf',
            'createdAt' => 'Aug 02, 2026',
        ],
        (object) [
            'originalName' => 'ui-designs.fig',
            'createdAt' => 'Aug 10, 2026',
        ],
        (object) [
            'originalName' => 'project-assets.zip',
            'createdAt' => 'Aug 15, 2026',
        ],
    ];

    $invoices = [
        (object) [
            'invoiceNumber' => 'INV-2026-001',
            'status' => 'paid',
            'issuedAt' => 'Aug 05, 2026',
            'amount' => 45000.00,
        ],
        (object) [
            'invoiceNumber' => 'INV-2026-002',
            'status' => 'pending',
            'issuedAt' => 'Aug 20, 2026',
            'amount' => 32500.00,
        ],
    ];
@endphp


<x-layouts.app title="Client Dashboard — ClientHub">

    <div class="dashboard">

        <!-- {{-- Page Header --}}
        <div class="dashboard-header">
            <div>
                <p class="eyebrow">CLIENT PORTAL</p>

                <h1>Client Dashboard</h1>

                <p class="dashboard-subtitle">
                    Track your project progress, review submitted work,
                    access files, and manage invoices.
                </p>
            </div>

            <div class="header-user">
                <span>Welcome back</span>
                <strong>{{ $userName }}</strong>
            </div>
        </div> -->

{{-- Current Project --}}
<x-card class="current-project-card">

    {{-- Top Section --}}
    <div class="current-project-header">

        <div class="project-title-section">

            <span class="project-label">
                CURRENT PROJECT
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
                {{ $project->clientName }}
            </strong>

        </div>


        <div class="project-info-item">

            <span class="info-label">
                Start Date
            </span>

            <strong>
                {{ $project->startDate ?? 'Not set' }}
            </strong>

        </div>


        <div class="project-info-item">

            <span class="info-label">
                Due Date
            </span>

            <strong>
                {{ $project->dueDate ?? 'Not set' }}
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
                {{ $project->progress ?? 0 }}%
            </strong>

        </div>


        <div class="progress-bar">

            <div
                class="progress-bar-fill"
                style="width: {{ $project->progress ?? 0 }}%"
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

                                            <button
                                                type="button"
                                                class="btn btn-success btn-small"
                                                onclick="
                                                    event.preventDefault();

                                                    if (confirm(
                                                        'Have you reviewed the submitted work and confirmed that you are satisfied?'
                                                    )) {
                                                        this.textContent = '✓ Completed';
                                                        this.disabled = true;
                                                    }
                                                "
                                            >
                                                Mark Complete
                                            </button>

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

                                    <div class="milestone-detail">

                                        <span class="detail-label">
                                            Due Date
                                        </span>

                                        <strong>
                                            {{ $milestone->dueDate ?? 'No due date' }}
                                        </strong>

                                    </div>


                                    @if($milestone->completedAt)

                                        <div class="milestone-detail">

                                            <span class="detail-label">
                                                Completed
                                            </span>

                                            <strong>
                                                {{ $milestone->completedAt }}
                                            </strong>

                                        </div>

                                    @endif


                                    @if($milestone->reviewUrl)

                                        <div class="milestone-detail milestone-review">

                                            <span class="detail-label">
                                                Submitted Work
                                            </span>

                                            <a
                                                href="{{ $milestone->reviewUrl }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="table-link"
                                            >
                                                View Submitted Work
                                            </a>

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
                                        {{ strtoupper(pathinfo($file->originalName, PATHINFO_EXTENSION)) ?: 'FILE' }}
                                    </div>

                                    <div>
                                        <strong>
                                            {{ $file->originalName }}
                                        </strong>

                                        <span>
                                            Uploaded
                                            {{ $file->createdAt }}
                                        </span>
                                    </div>

                                </div>

                                <a
                                    href="#"
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
                                {{ $invoice->invoiceNumber }}
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
                                {{ $invoice->issuedAt }}
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
                            href="#"
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
    </div>

</x-layouts.app>