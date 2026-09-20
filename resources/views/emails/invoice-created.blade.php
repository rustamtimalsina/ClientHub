<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; color: #1f2937; padding: 30px; }
        h1 { color: #2563eb; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        td { padding: 8px 0; border-bottom: 1px solid #e5e7eb; }
        .label { color: #6b7280; width: 40%; }
        .value { font-weight: bold; text-align: right; }
    </style>
</head>
<body>
    <h1>New Invoice for {{ $invoice->project->name }}</h1>
    <p>A new invoice has been added to your project.</p>

    <table>
        <tr>
            <td class="label">Invoice Number</td>
            <td class="value">{{ $invoice->invoice_number }}</td>
        </tr>
        <tr>
            <td class="label">Amount</td>
            <td class="value">NPR {{ number_format($invoice->amount, 2) }}</td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td class="value">{{ ucfirst($invoice->status) }}</td>
        </tr>
        <tr>
            <td class="label">Due Date</td>
            <td class="value">{{ $invoice->due_date?->format('M d, Y') ?? '—' }}</td>
        </tr>
    </table>

    <p style="margin-top: 20px;">
        <a href="{{ url('/dashboard') }}">View it on your dashboard</a>
    </p>
</body>
</html>