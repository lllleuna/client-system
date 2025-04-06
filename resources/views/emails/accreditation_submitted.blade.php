<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Accreditation Submission</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 40px; margin: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <tr>
            <td style="padding: 30px 40px;">
                <h2 style="color: #333333; margin-top: 0;">Accreditation Submission Received</h2>

                <p style="font-size: 16px; color: #555;">Hi <strong>{{ $tcName }}</strong>,</p>

                <p style="font-size: 16px; color: #555;">Thank you for submitting your application for accreditation.</p>

                <p style="font-size: 16px; color: #555;"><strong>Your Reference Number:</strong> <span style="color: #007bff;">{{ $referenceNumber }}</span></p>

                <p style="font-size: 16px; color: #555;">Updates regarding your accreditation status will be sent to this email address. Please allow <strong>7 to 10 business days</strong> for processing.</p>

                <div style="margin: 30px 0;">
                    <a href="https://client.otcs.digital/" target="_blank" style="display: inline-block; background-color: #007bff; color: #ffffff; text-decoration: none; padding: 12px 20px; border-radius: 5px; font-weight: bold;">Visit OTC Website</a>
                </div>

                <p style="font-size: 16px; color: #555;">Best regards,</p>
                <p style="font-size: 16px; font-weight: bold; color: #333;">Operations Team</p>
                <p style="font-size: 16px; color: #777;">Office of the Transportation Cooperatives</p>
            </td>
        </tr>
    </table>

    <div style="text-align: center; font-size: 12px; color: #aaa; margin-top: 20px;">
        © {{ date('Y') }} Office of the Transportation Cooperatives. All rights reserved.
    </div>
</body>
</html>
