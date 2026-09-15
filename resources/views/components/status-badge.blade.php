
@php
    $labels = [
        'completed' => 'Completed',
        'in_progress' => 'In Progress',
        'pending' => 'Pending',
        'paid' => 'Paid',
        'overdue' => 'Overdue',
    ];

    $label = $labels[$status] ?? ucfirst(str_replace('_', ' ', $status));
@endphp

<span class="badge">
    {{ $label }}
</span>
