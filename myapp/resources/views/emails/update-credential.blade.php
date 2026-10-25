<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Updated</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f4f7fb; font-family: Arial, Helvetica, sans-serif; color: #1f2937;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f7fb; padding: 40px 15px;">
        <tr>
            <td align="center">

                <table width="100%" cellpadding="0" cellspacing="0"
                    style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden;">

                    <!-- Header -->
                    <tr>
                        <td style="background-color: #2563eb; padding: 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 26px;">
                                {{ config('app.name') }}
                            </h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 35px;">

                            <h2 style="margin: 0 0 15px; font-size: 24px; color: #111827;">
                                Hi {{ $name }} 👋
                            </h2>

                            <p style="font-size: 16px; line-height: 1.7; color: #4b5563;">
                                Your account information has been successfully updated.
                            </p>

                            <!-- Account Details -->
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="margin-top: 25px; border: 1px solid #e5e7eb; border-radius: 8px;">

                                <tr>
                                    <td style="padding: 14px 16px; border-bottom: 1px solid #e5e7eb; color: #6b7280;">
                                        Name
                                    </td>
                                    <td
                                        style="padding: 14px 16px; border-bottom: 1px solid #e5e7eb; text-align: right; font-weight: bold;">
                                        {{ $name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 14px 16px; border-bottom: 1px solid #e5e7eb; color: #6b7280;">
                                        Email
                                    </td>
                                    <td
                                        style="padding: 14px 16px; border-bottom: 1px solid #e5e7eb; text-align: right; font-weight: bold;">
                                        {{ $email }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 14px 16px; color: #6b7280;">
                                        Role
                                    </td>
                                    <td
                                        style="padding: 14px 16px; text-align: right; font-weight: bold; color: #2563eb;">
                                        {{ $role_id }}
                                    </td>
                                </tr>

                            </table>

                            <p style="margin-top: 30px; font-size: 14px; line-height: 1.6; color: #6b7280;">
                                If you made this change, no further action is required.
                                If you did not make this change, please contact the administrator immediately.
                            </p>

                            <p style="margin-top: 30px; font-size: 16px; color: #374151;">
                                Thank you,<br>
                                <strong>{{ config('app.name') }}</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 20px 30px; text-align: center;">
                            <p style="margin: 0; font-size: 12px; color: #9ca3af;">
                                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>