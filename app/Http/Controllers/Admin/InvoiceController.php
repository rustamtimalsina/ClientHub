<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function create(Project $project)
    {
        $invoices = $project->invoices()->latest()->get();

        return view('admin.create-invoice', compact('project', 'invoices'));
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|max:255',
            'status' => 'required|in:pending,paid,overdue',
            'amount' => 'required|numeric|min:0',
            'issued_at' => 'nullable|date',
            'due_date' => 'nullable|date',
        ]);

        $project->invoices()->create($validated);

        return redirect()->route('admin.invoices.create', $project)
            ->with('success', 'Invoice added successfully.');
    }

    public function update(Request $request, Project $project, Invoice $invoice)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|max:255',
            'status' => 'required|in:pending,paid,overdue',
            'amount' => 'required|numeric|min:0',
            'issued_at' => 'nullable|date',
            'due_date' => 'nullable|date',
        ]);

        $invoice->update($validated);

        return redirect()->route('admin.invoices.create', $project)
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Project $project, Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.create', $project)
            ->with('success', 'Invoice deleted successfully.');
    }
}