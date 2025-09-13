<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Property Posted</title>
</head>
<body>
    <h2>New Property Posted</h2>
    <p><strong>Title:</strong> {{ $property->title }}</p>
    <p><strong>Posted By:</strong> {{ $property->user->name }} ({{ $property->user->email }})</p>
    <p><strong>Plan:</strong> {{ $property->plan->name ?? 'Free' }}</p>
    <p><strong>Status:</strong> {{ $property->status ? 'Approved' : 'Pending' }}</p>
</body>
</html>
