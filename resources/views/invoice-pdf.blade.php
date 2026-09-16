<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; color: #1f2937; padding: 40px; }
        h1 { color: #2563eb; margin-bottom: 0; }
        .meta { color: #6b7280; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 10px 0; border-bottom: 1px solid #e5e7eb; }
        .label { color: #6b7280; width: 40%; }
        .value { font-weight: bold; text-align: right; }
        .amount { font-size: 20px; color: #2563eb; }
    </style>
</head>
<body>
    <h1>ClientHub</h1>
    <p class="meta">Invoice {{ $invoice->invoice_number }}</p>

    <table>
        <tr>
            <td class="label">Project</td>
            <td class="value">{{ $invoice->project->name }}</td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td class="value">{{ ucfirst($invoice->status) }}</td>
        </tr>
        <tr>
            <td class="label">Issued</td>
            <td class="value">{{ $invoice->issued_at?->format('M d, Y') ?? '—' }}</td>
        </tr>
        <tr>
            <td class="label">Due</td>
            <td class="value">{{ $invoice->due_date?->format('M d, Y') ?? '—' }}</td>
        </tr>
        <tr>
            <td class="label">Amount</td>
            <td class="value amount">NPR {{ number_format($invoice->amount, 2) }}</td>
        </tr>
    </table>
</body>
</html>