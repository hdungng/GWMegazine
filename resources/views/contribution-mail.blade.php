<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post Submission Notification</title>
</head>

<body>
    <p>This is an automated notification to inform you that a new post has been submitted on our platform. Kindly review
        the details below:</p>
    <ul>
        <li><strong>Title:</strong> {{ $contributionTitle  }}</li>
        <li><strong>Submitted By:</strong> {{ Auth::user()->fullname   }}</li>
    </ul>
    <p>Please ensure that the content complies with our guidelines and standards. If any action is required, kindly
        address it promptly.</p>
    <p>You can access the submitted post by logging into the admin panel and navigating to the submissions section.</p>
    <p>Thank you.</p>
</body>

</html>
