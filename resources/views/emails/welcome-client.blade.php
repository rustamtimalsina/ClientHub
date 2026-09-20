<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; color: #1f2937; padding: 30px; }
        h1 { color: #2563eb; }
    </style>
</head>
<body>
    <h1>Welcome to ClientHub, {{ $client->name }}!</h1>
    <p>An account has been created for you.</p>
    <p><strong>Email:</strong> {{ $client->email }}</p>
    <p>You can log in at: <a href="{{ url('/login') }}">{{ url('/login') }}</a></p>
    <p>If you have any questions, please reach out to your project manager.</p>
</body>
</html>