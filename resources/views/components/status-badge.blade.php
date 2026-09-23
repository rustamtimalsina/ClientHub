@php
    $labels = [
        'completed' => 'Completed',
        'in_progress' => 'In Progress',
        'pending' => 'Pending',
        'paid' => 'Paid',
        'overdue' => 'Overdue',
    ];

    $label = $label ?? ($labels[$status] ?? ucfirst(str_replace('_', ' ', $status)));

    // NEW: pick a color group per status
    $classes = [
        'completed' => 'badge-success',
        'paid' => 'badge-success',
        'in_progress' => 'badge-warning',
        'pending' => 'badge-neutral',
        'overdue' => 'badge-danger',
    ];

    $class = $classes[$status] ?? 'badge-neutral';
@endphp

<span class="badge {{ $class }}">
    {{ $label }}
</span>