<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Invitation</title>
</head>
<body>
    <h2>Invitation and Login Details</h2>

    <p>Dear {{ $member->email }},</p>

    <p>You have been invited to join the {{ $member->department->name }} department.</p>

    <p>Please find below your login details:</p>

    <ul>
        <li>Email: {{ $member->email }}</li>
        <li>Password: ********</li> <!-- Insert the member's password here -->
    </ul>

    <p>Visit our website at <a href="{{ url('/') }}">unicon.com</a> to log in and access your account.</p>

    <p>Thank you!</p>
</body>
</html>
