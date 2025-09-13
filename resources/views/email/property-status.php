<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $mailData['subject'] }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f8fa; padding: 30px;">

<h2>{{ $mailData['subject'] }}</h2>
    <p>Dear {{ $mailData['property']->user->name }},</p>

    @if($mailData['property']->status == 1)
        <p>Your property <strong>{{ $mailData['property']->title }}</strong> has been activated successfully.</p>
    @else
        <p>Your property <strong>{{ $mailData['property']->title }}</strong> has been deactivated.</p>
    @endif

    <p>Thank you,<br> {{ config('app.name') }}</p>
  
</body>
</html>
