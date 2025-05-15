<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application Submitted</title>
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
      background-color: #4267B2;
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
      color: #4267B2;
      background-color: #f0f4ff;
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
      color: #4267B2;
    }
    
    .email-footer {
      background-color: #f8f8f8;
      padding: 20px 30px;
      border-top: 1px solid #eeeeee;
      font-size: 13px;
      color: #777;
      text-align: center;
    }
    
    .checkmark {
      display: block;
      width: 50px;
      height: 50px;
      background-color: #50C878;
      border-radius: 50%;
      color: white;
      font-size: 24px;
      line-height: 50px;
      text-align: center;
      margin: 0 auto 20px;
    }
    
    .status-box {
      background-color: #f0f8ff;
      border-left: 4px solid #4267B2;
      padding: 15px;
      margin: 25px 0;
      border-radius: 4px;
    }
    
    .status-title {
      font-weight: bold;
      margin-bottom: 5px;
      color: #4267B2;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="email-header">
      <h1>CGS Renewal</h1>
    </div>
    
    <div class="email-body">
      <div class="checkmark">✓</div>
      
      <p>Dear {{ $application->tc_name }},</p>
      
      <p>
        We are pleased to confirm that your application has been successfully submitted.
      </p>
      
      <div class="status-box">
        <div class="status-title">Application Details</div>
        <p style="margin-bottom: 0">Reference Number: <span class="reference">{{ $application->reference_number }}</span></p>
      </div>
      
      <p>
        Our team will carefully review your application within the next 1-2 business days. You will be notified of any updates regarding your application status.
      </p>
      
      <p>Thank you for your application.</p>
      
      <div class="signature">
        <p>
          Best regards,<br>
          <span class="signature-name">Operations Team</span>
        </p>
      </div>
    </div>
    
    <div class="email-footer">
      <p>This is an automated message. Please do not reply to this email.</p>
    </div>
  </div>
</body>
</html>