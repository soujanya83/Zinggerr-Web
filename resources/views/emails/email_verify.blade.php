<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Email</title>
</head>
<body>
    <h1>Hello, {{ $userName }}!</h1>
    <p>Please click the button below to verify your email address:</p>
    <a href="{{ $verificationUrl }}" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Verify Email</a>
    <p>If you did not create an account, no further action is required.</p>
    <p>Thank you,</p>
    <p>Your Application Team</p>
</body>
</html>
