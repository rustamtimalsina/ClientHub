<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Redirecting to eSewa...</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
            background: #f6f7fb;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: #1e1b4b;
        }
        .box { text-align: center; }
        .spinner {
            width: 36px; height: 36px;
            border: 4px solid #e4e4f0;
            border-top-color: #4f46e5;
            border-radius: 50%;
            margin: 0 auto 16px;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>
    <div class="box">
        <div class="spinner"></div>
        <p>Redirecting you to eSewa to complete your payment...</p>
    </div>

    <form id="esewaForm" action="{{ config('services.esewa.base_url') }}" method="POST">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="tax_amount" value="0">
        <input type="hidden" name="total_amount" value="{{ $amount }}">
        <input type="hidden" name="transaction_uuid" value="{{ $transactionUuid }}">
        <input type="hidden" name="product_code" value="{{ config('services.esewa.merchant_code') }}">
        <input type="hidden" name="product_service_charge" value="0">
        <input type="hidden" name="product_delivery_charge" value="0">
        <input type="hidden" name="success_url" value="{{ route('payment.success') }}">
        <input type="hidden" name="failure_url" value="{{ route('payment.failure') }}">
        <input type="hidden" name="signed_field_names" value="{{ $signedFieldNames }}">
        <input type="hidden" name="signature" value="{{ $signature }}">
    </form>

    <script>
        document.getElementById('esewaForm').submit();
    </script>
</body>
</html>