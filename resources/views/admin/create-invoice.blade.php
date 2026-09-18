<x-layouts.app title="Invoices — Admin">

    <div class="dashboard">

        <div class="dashboard-welcome">
            <div>
                <p class="dashboard-eyebrow">Admin</p>
                <h1>{{ $project->name }}</h1>
                <p>Add and manage invoices for this project.</p>
            </div>
        </div>

        @if(session('success'))
            <x-card>
                <p style="color: #16a34a; font-weight: bold;">{{ session('success') }}</p>
            </x-card>
        @endif

        <x-card title="Add Invoice">

            <form method="POST" action="{{ route('admin.invoices.store', $project) }}">
                @csrf

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Invoice Number</label>
                    <input type="text" name="invoice_number" required placeholder="INV-2026-003" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Amount (NPR)</label>
                    <input type="number" step="0.01" name="amount" required style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Status</label>
                    <select name="status" required style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="overdue">Overdue</option>
                    </select>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Issued Date</label>
                    <input type="date" name="issued_at" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="display:block; margin-bottom:4px; font-weight:bold;">Due Date</label>
                    <input type="date" name="due_date" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border);">
                </div>

                <button type="submit" class="btn btn-success">Add Invoice</button>

            </form>

        </x-card>

        <x-card title="Existing Invoices">

            @if($invoices->isEmpty())
                <x-empty-state
                    title="No invoices yet"
                    message="Add one above to get started."
                />
            @else
                <div class="client-invoice-list">
                    @foreach($invoices as $invoice)
                        <div class="client-invoice-card">
                            <div class="invoice-card-header">
                                <div>
                                    <span class="invoice-number">{{ $invoice->invoice_number }}</span>
                                </div>
                                <x-status-badge :status="$invoice->status" />
                            </div>
                            <div class="invoice-card-details">
                                <div>
                                    <span class="invoice-label">Amount</span>
                                    <strong class="invoice-amount">NPR {{ number_format($invoice->amount, 2) }}</strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </x-card>

    </div>

</x-layouts.app>