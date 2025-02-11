<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>


<style>
    /* General Reset */
    body, p, h1, h2, h3, h4, h5, h6 {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }
    body {
        background-color: #f6f6f6;
        margin: 0;
        padding: 0;
    }
    table {
        width: 100%;
        border-spacing: 0;
    }
    .email-container {
        background-color: #ffffff;
        max-width: 600px;
        margin: 20px auto;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .header {
        background-color: #003366;
        padding: 20px;
        text-align: center;
        color: #ffffff;
        font-size: 24px;
        font-weight: bold;
    }
    .content {
        padding: 20px;
        text-align: left;
        color: #333333;
        line-height: 1.6;
    }
    .content p {
        margin-bottom: 10px;
    }
    .otp-box {
        display: block;
        margin: 20px auto;
        padding: 10px 0;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color: #003366;
        background-color: #f0f8ff;
        border-radius: 4px;
        width: 200px;
    }
    .footer {
        text-align: center;
        font-size: 12px;
        color: #777777;
        padding: 10px;
    }
    .footer a {
        color: #003366;
        text-decoration: none;
    }
</style>
</head>

<body style="color: #eceaea">
    <div class="email-container">
        <div class="header">
            Zinggerr
        </div>
        <div class="content" style="background-color: #e0ebef;">
            <a href="{{ url('https://www.zinggerr.com') }}" target="_blank" class="d-flex justify-content-center">
                <img src="https://www.zinggerr.com/asset/images/logo.png" alt="Zinggerr Logo" style="max-width: 40%;">

            </a>
            <p style="margin-top: 12px;">Hi {{ $userName }},</p>
            <p>Click the button below to verify your email address:</p>
            <p style="text-align: center;">
                <a href="{{ $verificationUrl }}" class="verify-button"style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Verify Email</a>
            </p>
            <p>If you didn't request this verification, ignore this email.</p>
            <br>
            <p>Thank you,<br>Team Zinggerr</p>
        </div>
        <div class="header">
            © 2024 Zinggerr. All rights reserved. <br>
            {{-- <a href="#">Unsubscribe</a> | <a href="#">Contact Us</a> --}}
        </div>
    </div>
</body>
</html>
