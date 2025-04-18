<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application Submitted</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 20px;
      color: #333;
      line-height: 1.6;
    }
    
    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .email-header {
      background-color: #e3e9fe;
      color: white;
      padding: 20px;
    }
    
    .email-header h1 {
      margin: 0;
      font-size: 22px;
    }
    
    .email-body {
      padding: 25px;
    }
    
    .reference {
      font-weight: bold;
    }
    
    p {
      margin: 0 0 16px 0;
    }
    
    .signature {
      margin-top: 25px;
    }
    
    .signature-name {
      font-weight: bold;
    }
    
    .email-footer {
      background-color: #f8f8f8;
      padding: 15px 25px;
      border-top: 1px solid #e0e0e0;
      font-size: 12px;
      color: #777;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="email-header">
      <h1>CGS Renewal</h1>
    </div>
    
    <div class="email-body">
      <p>Dear {{ $application->tc_name }},</p>
      
      <p>
        We are pleased to confirm that your application (Reference No: <span class="reference">{{ $application->reference_number }}</span>) has been successfully submitted.
      </p>
      
      <p>
        Our team will carefully review your application within the next 1-2 business days. You will be notified of any updates regarding your application status.
      </p>
      
      <p>
        If you have any questions or require further assistance, please don't hesitate to contact OTC.
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