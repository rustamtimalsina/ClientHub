<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; color: #1f2937; padding: 30px; }
        h1 { color: #16a34a; }
    </style>
</head>
<body>
    <h1>✓ Milestone Completed</h1>
    <p><strong>{{ $milestone->title }}</strong> on your project
        <strong>{{ $milestone->project->name }}</strong> has been marked as complete.</p>

    @if($milestone->description)
        <p>{{ $milestone->description }}</p>
    @endif

    <p style="margin-top: 20px;">
        <a href="{{ url('/dashboard') }}">View it on your dashboard</a>
    </p>
</body>
</html>