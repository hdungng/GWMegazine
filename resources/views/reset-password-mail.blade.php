<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Notification</title>
</head>

<body>
    <div>
        <h2 style="text-align: center;">Welcome to Our Platform!</h2>
        <p>Hello,</p>
        <p>Welcome to our platform! We've created an account for you with the following details:</p>
        <ul>
            <li>Email: {{ $email }}</li>
            <li>Password: <strong>{{ $defaultPassword }}</strong></li>
        </ul>
        <p>You can use this default password to log in to your account. However, for security reasons, we highly
            recommend that you reset your password immediately after logging in for the first time.</p>
        <p>To reset your password, simply log in to your account, navigate to the settings or profile section, and
            choose the option to reset your password.</p>
        <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
        <p>Best Regards,<br>GWMegazine</p>
    </div>
</body>

</html>
