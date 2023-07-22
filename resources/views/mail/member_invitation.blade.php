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

    <p>Please find below your login details:</p>

    <ul>
        <li>Email: {{ $member->email }}</li>
        <li>Password: {{ $password }}</li> 
    </ul>

    <p>Visit our website at <a href="{{ url('/') }}">unicorn</a> to log in and access your account.</p>

    <p>Thank you!</p>
</body>
</html>
