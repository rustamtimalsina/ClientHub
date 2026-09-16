<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function download(Invoice $invoice)
    {
        abort_unless(
            $invoice->project->client_id === Auth::id(),
            403
        );

        $content = "ClientHub Invoice\n";
        $content .= "==================\n\n";
        $content .= "Invoice Number: {$invoice->invoice_number}\n";
        $content .= "Project: {$invoice->project->name}\n";
        $content .= "Status: {$invoice->status}\n";
        $content .= "Issued: " . ($invoice->issued_at?->format('M d, Y') ?? '—') . "\n";
        $content .= "Due: " . ($invoice->due_date?->format('M d, Y') ?? '—') . "\n";
        $content .= "Amount: NPR " . number_format($invoice->amount, 2) . "\n";

        return response()->streamDownload(
            fn () => print($content),
            "{$invoice->invoice_number}.txt"
        );
    }
}