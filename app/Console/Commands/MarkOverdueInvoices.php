<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use Illuminate\Console\Command;

class MarkOverdueInvoices extends Command
{
    protected $signature = 'invoices:mark-overdue';

    protected $description = 'Mark unpaid invoices as overdue once their due date has passed';

    public function handle()
    {
        $count = Invoice::where('status', 'pending')
            ->whereNotNull('due_date')
            ->where('due_date', '<', now())
            ->update(['status' => 'overdue']);

        $this->info("Marked {$count} invoice(s) as overdue.");
    }
}