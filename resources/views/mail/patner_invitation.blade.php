<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner Invitation</title>
</head>
<body>
    <h2>Partner Invitation</h2>

    <p>Greetings!,</p>

    <p>{{ $partnerName }} have  invited you to their organization.</p>

    @if ($actionType === 'login' && $member)
        <p>Please find below your login details:</p>
        <ul>
            <li>Email: {{ $member->email }}</li>
            <li>Password: {{ $password }}</li>
        </ul>
        <p>Visit our website at <a href="{{ $url }}">Unicorn</a> to log in and access your account.</p>
    @else
        <p>Visit our website at <a href="{{ $url }}">Unicorn</a> to register and access your account.</p>
    @endif

    <p>Thank you!</p>
</body>
</html>
