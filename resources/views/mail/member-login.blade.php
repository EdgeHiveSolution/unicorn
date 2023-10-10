<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Invitation</title>
</head>
<body>
    <h2>Department Invitation</h2>

    <p>Greetings!,</p>

    <p>You have been invited to join the {{ $departmentName }} department.</p>

    @if ($actionType === 'login' && $member)
       
        <p>Visit our website at <a href="{{ $url }}">Unicorn</a> to log in and access your account.</p>
        <p>Password: {{ $password }} </p>
    @else
        <p>Visit our website at <a href="{{ $url }}">Unicorn</a> to register and access your account.</p>
    @endif

    <p>Thank you!</p>
</body>
</html>
