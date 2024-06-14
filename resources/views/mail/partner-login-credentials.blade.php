<!DOCTYPE html>
<html>

<head>
    <title>Partner Login Credentials</title>
</head>

<body>
    <p>Greetings, {{ $partner->name }},</p>

    <p>Your login credentials at Unicn are as follows:</p>
    <p>Email: {{ $partner->email }}</p>
    <p>Password: {{ $password }}</p>

    <p>You can log in using the following link:</p>
    <a href="{{ $loginLink }}">Unicn</a>

    <p>Thank You</p>
</body>

</html>
