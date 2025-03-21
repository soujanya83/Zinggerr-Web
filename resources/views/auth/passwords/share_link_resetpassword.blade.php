<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>


    <style>
        /* General Reset */
        body,
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
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
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- <body style="color: #eceaea">
    <div class="email-container">
        <div class="header">
            Zinggerr
        </div>
        <div class="content" style="background-color: #e0ebef; padding: 20px; font-family: Arial, sans-serif;">
            <a href="{{ url('https://www.zinggerr.com') }}" target="_blank" class="d-flex justify-content-center">
                <img src="https://www.zinggerr.com/asset/images/logo.png" alt="Zinggerr Logo" style="max-width: 40%;">
            </a>

            <p style="margin-top: 12px;">Hi {{ $userName }},</p>

            <p>We received a request to reset your password. Use the OTP below to proceed. This OTP is valid for
                <strong>5 minutes</strong>:
            </p>
            <p
                style="text-align: center;margin-left: 35%; font-size: 18px; font-weight: bold; background-color: #ffffff; padding: 10px; border-radius: 8px; display: inline-block;">
                OTP: {{ $otp }}
            </p>

            <p>Please Do not share this OTP with anyone for security reasons.</p>
            <br>
            <p>Thank you,<br><strong>Team Zinggerr</strong></p>
        </div>

        <div class="header" style="margin-top: -15px;">
            © 2024 Zinggerr. All rights reserved. <br>
        </div>
    </div>
</body> --}}


<body style="color: #eceaea">
    <div class="email-container">
        <div class="header">
            Zinggerr
        </div>
        <div class="content" style="background-color: #e0ebef; padding: 20px; font-family: Arial, sans-serif;">
            <a href="{{ url('https://www.zinggerr.com') }}" target="_blank" class="d-flex justify-content-center">
                <img src="https://www.zinggerr.com/asset/images/logo.png" alt="Zinggerr Logo" style="max-width: 40%;">
            </a>

            <p style="margin-top: 12px;">Hi {{ $userName }},</p>

            <p>Your account has been created successfully as a <strong>{{ $userType }}</strong>. Below are your login details:</p>

            <div style="background-color: rgb(224 235 239); padding: 10px;">
                <p><strong>Username:</strong> {{ $username }}</p>
                <p><strong>Email:</strong> {{ $email }}</p>
                <p><strong>Password:</strong> {{ $password }}</p>
            </div>

            <p style="text-align: center;">
                <a href="{{ route('loginpage') }}" target="_blank" style="display: inline-block; background-color: #038b3a; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                    Login
                </a>
            </p>

            <p>Please do not share your login details with anyone for security reasons.</p>
            <br>
            <p>Thank you,<br><strong>Team Zinggerr</strong></p>
        </div>

        <div class="header" style="margin-top: -15px;">
            © 2024 Zinggerr. All rights reserved. <br>
        </div>
    </div>
</body>


</html>
