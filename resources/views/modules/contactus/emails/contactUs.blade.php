<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #4CAF50;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
            color: #333333;
        }
        .content p {
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .content .highlight {
            color: #4CAF50;
            font-weight: bold;
        }
        .footer {
            background: #f4f4f9;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #777777;
        }
        .button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <h1>Contact Us Request</h1>
    </div>
    <div class="content">
        <p>Hello,</p>
        <p>We have received new message from: <span class="highlight">{{ ' '.$details['name'] }}</span></p>
        <blockquote>
            <p>Email: {{ $details['email'] }}</p>
            <p>Phone: {{ $details['phone'] }}</p>
            <p>Subject: {{ $details['subject'] }}</p>
            <p>Massage: {{ $details['massage'] }}</p>
        </blockquote>
{{--        <p>Thank you for reaching out to us. We will review your message and get back to you shortly.</p>--}}
{{--        <a href="{{ '$action_url' }}" class="button">View Your Request</a>--}}
    </div>
    <div class="footer">
{{--        <p>Need help? Contact us at support@example.com</p>--}}
        <p>&copy; {{ date('Y') }} Company Name. All rights reserved.</p>
    </div>
</div>
</body>
</html>
