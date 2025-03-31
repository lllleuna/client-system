<!DOCTYPE html>
<html>
<head>
    <title>Application Submitted</title>
</head>
<body>
    <p>Dear {{ $application->tc_name }},</p>
    <p>Your application (ID: {{ $application->reference_number }}) has been successfully submitted.</p>
    <p>We will review your application and notify you of any updates.</p>
    <p>Thank you!</p>
</body>
</html>
