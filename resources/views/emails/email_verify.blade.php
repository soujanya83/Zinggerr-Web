<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email OTP Template</title>
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
<body>
    <table>
        <tr>
            <td>
                <!-- Email Container -->
                <div class="email-container">
                    <!-- Header -->
                    <div class="header">
                       Zinggerr
                    </div>
                    <!-- Content -->
                    <div class="content">
                        <p>Hi ABCD,</p>
                        <p>Verify your email address. Below is your <strong>One time password:</strong></p>
                        <div class="otp-box">
                            OTP: 12345
                        </div>
                        <p>If you didn't request this one-time password, ignore this email.</p>
                        <p>If you'd like to know more about Zinggerr or want to get in touch with us, reach out to our customer support team.</p>
                        <br>
                        <p>Thank you,<br>Team Zinggerr</p>
                    </div>
                    <!-- Footer -->
                    <div class="footer">
                        © 2024Zinggerr. All rights reserved. <br>
                        <a href="#">Unsubscribe</a> | <a href="#">Contact Us</a>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
