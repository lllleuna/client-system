<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Training Request Confirmation</title>
</head>
<body>
    <p>Hi {{ $user->tc_name }},</p>

    <p>Your training request has been successfully received by the OTC.</p>

    <p><strong>Reference Number:</strong> {{ $reference_no }}</p>

    <p>Please wait 5 to 24 hours for processing.</p>

    <p>Best regards,<br>
    Operational Team</p>
</body>
</html>
