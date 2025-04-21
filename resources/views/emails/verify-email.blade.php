<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 550px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }
        
        .email-header {
            background-color: #3b82f6;
            color: white;
            padding: 25px 30px;
            text-align: center;
        }
        
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 0.5px;
        }
        
        .email-body {
            padding: 35px 30px;
            text-align: center;
        }
        
        p {
            margin: 0 0 20px 0;
            font-size: 16px;
        }
        
        .verification-button {
            display: inline-block;
            background-color: #3b82f6;
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 6px;
            margin: 25px 0;
            font-size: 16px;
        }
        
        .link-container {
            margin: 20px 0;
            padding: 15px;
            background-color: #f0f9ff;
            border-radius: 6px;
            word-break: break-all;
            text-align: left;
        }
        
        .email-footer {
            background-color: #f8fafc;
            padding: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 13px;
            color: #6b7280;
            text-align: center;
        }
        
        .verification-icon {
            width: 70px;
            height: 70px;
            background-color: #3b82f6;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .verification-icon-inner {
            color: white;
            font-size: 35px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Email Verification</h1>
        </div>
        
        <div class="email-body">
            <div class="verification-icon">
                <div class="verification-icon-inner">✉️</div>
            </div>
            
            <h2>Verify Your Email Address</h2>
            
            <p>Thank you for registering! Please verify your email address to activate your account.</p>
            
            <a href="{{ $verificationLink }}" class="verification-button">Verify Email Address</a>
            
            <p>Or click the link below:</p>
            
            <div class="link-container">
                <a href="{{ $verificationLink }}">{{ $verificationLink }}</a>
            </div>
            
            <p>If you didn't create this account, you can safely ignore this email.</p>
        </div>
        
        <div class="email-footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>