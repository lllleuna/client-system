<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Request Confirmation</title>
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
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }
        
        .email-header {
            background-color: #009688;
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
        }
        
        .reference {
            font-weight: bold;
            color: #009688;
            background-color: #e0f2f1;
            padding: 2px 8px;
            border-radius: 4px;
        }
        
        p {
            margin: 0 0 18px 0;
            font-size: 15px;
        }
        
        .signature {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
        }
        
        .signature-name {
            font-weight: bold;
            color: #009688;
        }
        
        .email-footer {
            background-color: #f8f8f8;
            padding: 20px 30px;
            border-top: 1px solid #eeeeee;
            font-size: 13px;
            color: #777;
            text-align: center;
        }
        
        .notification-icon {
            display: block;
            width: 60px;
            height: 60px;
            background-color: #009688;
            border-radius: 50%;
            color: white;
            font-size: 30px;
            line-height: 60px;
            text-align: center;
            margin: 0 auto 20px;
        }
        
        .status-box {
            background-color: #e0f2f1;
            border-left: 4px solid #009688;
            padding: 15px;
            margin: 25px 0;
            border-radius: 4px;
        }
        
        .status-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #009688;
        }
        
        .processing-info {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Training Request Confirmation</h1>
        </div>
        
        <div class="email-body">
            <div class="notification-icon">✓</div>
            
            <p>Hi {{ $user->tc_name }},</p>
            
            <p>Your training request has been successfully received by the OTC.</p>
            
            <div class="status-box">
                <div class="status-title">Request Details</div>
                <p style="margin-bottom: 0"><strong>Reference Number:</strong> <span class="reference">{{ $reference_no }}</span></p>
            </div>
            
            <div class="processing-info">
                <p style="margin-bottom: 0"><strong>Note:</strong> Please allow 5 to 24 hours for processing. You will receive a notification once your request has been processed.</p>
            </div>
            
            <div class="signature">
                <p>
                    Best regards,<br>
                    <span class="signature-name">Operational Team</span>
                </p>
            </div>
        </div>
        
        <div class="email-footer">
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>