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

        @if($errors->any())
            <x-card>
                <p style="color: #dc2626; font-weight: bold;">{{ $errors->first() }}</p>
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

                            <form method="POST" action="{{ route('admin.invoices.update', [$project, $invoice]) }}">
                                @csrf
                                @method('PUT')

                                <div style="margin-bottom: 10px;">
                                    <input type="text" name="invoice_number" required value="{{ $invoice->invoice_number }}" style="width:100%; padding:8px; border-radius:6px; border:1px solid var(--border); font-weight:bold;">
                                </div>

                                <div style="display:flex; gap:10px; margin-bottom: 10px;">
                                    <input type="number" step="0.01" name="amount" required value="{{ $invoice->amount }}" style="flex:1; padding:8px; border-radius:6px; border:1px solid var(--border);">

                                    <select name="status" required style="padding:8px; border-radius:6px; border:1px solid var(--border);">
                                        <option value="pending" @selected($invoice->status === 'pending')>Pending</option>
                                        <option value="paid" @selected($invoice->status === 'paid')>Paid</option>
                                        <option value="overdue" @selected($invoice->status === 'overdue')>Overdue</option>
                                    </select>
                                </div>

                                <div style="display:flex; gap:10px; margin-bottom: 10px;">
                                    <input type="date" name="issued_at" value="{{ $invoice->issued_at?->format('Y-m-d') }}" style="flex:1; padding:8px; border-radius:6px; border:1px solid var(--border);">
                                    <input type="date" name="due_date" value="{{ $invoice->due_date?->format('Y-m-d') }}" style="flex:1; padding:8px; border-radius:6px; border:1px solid var(--border);">
                                </div>

                                <button type="submit" class="btn btn-small">Save</button>
                            </form>

                            <form method="POST" action="{{ route('admin.invoices.destroy', [$project, $invoice]) }}" onsubmit="return confirm('Delete this invoice?');" style="margin-top: 10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-small" style="background: #dc2626; color: white; border: none;">
                                    Delete
                                </button>
                            </form>

                        </div>
                    @endforeach
                </div>
            @endif


        </x-card>
        </div>

</x-layouts.app>